<?php

namespace Snono\PDFBuilder\Builder\Classes;


use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Snono\PDFBuilder\Builder\Classes\Setters;
use Snono\PDFBuilder\Builder\Classes\Getters;
use Illuminate\Support\Collection;

use Storage;

/**
 * This is the report-builder class.
 *
 * @author Yaser Ghanawi
 */
class PDFBuilder
{
    use Setters, Getters;

    /**
     * CSS File Name.
     *
     * @var string
     */
    private $_cssFiles;

    /**
     * blade template name.
     *
     * @var string
     */
    private $_template;

    /**
     * rientation pdf file.
     *
     * @var string P|L
     */
    private $_orientation = null;

    /**
     * rDirectionality.
     *
     * @var string $orientation rtl|ltr
     */
    private $_directionality = null;

    /**
     * the Header template.
     *
     * @var string
     */
    private $_header = null ;

    /**
     * report-builder item collection.
     *
     * @var Illuminate\Support\Collection
     */
    private $_htmlHeader;

    /**
     * the Footer template.
     *
     * @var string
     */
    private $_footer = null;

    /**
     * report-builder tax.
     *
     * @var Illuminate\Support\Collection
     */
    private $_htmlFooter ;

    /**
     * the send it to specified destination.
     *
     * @var string
     */
    private $_destination;

    /**
     * which languages are auto-detected.
     *
     * @var int
     */
    private $_autoFont = 15;

    /**
     * the data report.
     *
     * @var Illuminate\Support\Collection
     */
    private $_pdf_data;

    /**
     * the mode char utf-8.
     *
     * @var string
     */
    private $_mode = 'utf-8';

    /**
     * the format page .
     *
     * @var string
     */
    private $_format = 'A4';

    /**
     * the page scale.
     *
     * @var string
     */
    private $_display_mode =  'fullpage';

    /**
     * the dir path save file.
     *
     * @var string
     */
    private $_tempDir;

    /**
     *  use support arabic language.
     *
     * @var string
     */
    private $_unAGlyphs = true;

    /**
     * Stores the PDF object.
     *
     * @var Mpdf\Mpdf
     */
    private $mpdf;

    /**
     * Create a new report instance.
     *
     * @method __construct
     *
     * @param string $name
     */
    public function __construct($name = 'pdf')
    {
        $this->_pdf_data = Collection::make([]);
        $this->_mode = config($name.'.mode');
        $this->_format = config($name.'.format');
        $this->_display_mode = config($name.'.display_mode');
        $this->_tempDir = config($name.'.tempDir');
        $this->_unAGlyphs = config($name.'.unAGlyphs');
        $this->_htmlFooter = Collection::make([]);
        $this->_htmlHeater = Collection::make([]);

    }

    /**
     * Return a new instance of report-builder.
     *
     * @method make
     *
     * @param string $name
     *
     * @return Snono\ReportBuilder\Classes\ReportBuilder
     */
    public static function make($name = 'pdf')
    {
        return new self($name);
    }




    /**
     * Return the currency object.
     *
     * @method formatCurrency
     *
     * @return stdClass
     */
    public function formatCurrency()
    {
        $currencies = json_decode(file_get_contents(__DIR__.'/../Currencies.json'));
        $currency = $this->currency;

        return $currencies->$currency;
    }



    /**
     * Generate the PDF.
     *
     * @method generate
     *
     * @return self
     */
    private function generate()
    {

        $mpdf_config = [
            'mode'                 =>   $this->_mode,
            'format'               =>   $this->_format,
//            'display_mode'         =>   $this->_display_mode,
            'tempDir'              =>   $this->_tempDir,
            'unAGlyphs'            =>   $this->_unAGlyphs,
            'img_dpi'              =>   200
        ];


        $this->mpdf = new Mpdf($mpdf_config);
        $this->mpdf->dpi = 150;
        $this->mpdf->img_dpi = 150;
        $emogrifier = new Emogrifier();

        $html = View::make($this->getTemplate(), ['data' => $this->getData()])->render();
        $emogrifier->setHtml($html);
        $emogrifier->setCss($this->getCssUrls());

        $this->mpdf->use_kwt = true;
        if($this->getHeader()) {
            $this->mpdf->SetHeader($this->getHeader(), 'E');
            $this->mpdf->SetHeader($this->getHeader(), 'O');
        }

        if($this->getFooter()) { // 'Document Title|{PAGENO}|{DATE j-m-Y}'
            $this->mpdf->SetFooter($this->getFooter(),'E');
            $this->mpdf->SetFooter($this->getFooter(),'O');
        }

//        if(is_object($this->getHtmlHeader())) {
//            $this->mpdf->SetHTMLHeader($this->getHtmlHeader()->html,$this->getHtmlHeader()->write,$this->getHtmlHeader()->side);
//        }
//
//        if(is_object($this->getHtmlFooter())) {
//            $this->mpdf->SetHTMLFooter($this->getHtmlFooter()->html,$this->getHtmlFooter()->side);
//        }


        if($this->getDirectionality()) {
            $this->mpdf->SetDirectionality($this->getDirectionality());
        }

        $this->mpdf->WriteHTML($emogrifier->emogrify());

        return $this;
    }

    /**
     * Downloads the generated PDF.
     *
     * @method download
     *
     * @param string $name
     *
     * @return response
     */
    public function download($name = 'report')
    {
        $this->generate();

        return $this->mpdf->Output($name , \Mpdf\Output\Destination::DOWNLOAD);
    }

    /**
     * Save the generated PDF.
     *
     * @method save
     *
     * @param string $name
     *
     */
    public function save($name = 'invoice.pdf')
    {
        $invoice = $this->generate();

        Storage::put($name, $invoice->mpdf->Output($name , Mpdf\Output\Destination::FILE));
    }

    /**
     * Show the PDF in the browser.
     *
     * @method show
     *
     * @param string $name
     *
     * @return response
     */
    public function show($name = 'invoice')
    {
        $this->generate();

        return $this->mpdf->Output($name, \Mpdf\Output\Destination::INLINE);
    }

    /**
     * Show the PDF in the browser.
     *
     * @method toString
     *
     * @param string $name
     *
     * @return response
     */
    public function toString()
    {
        $this->generate();

        return $this->mpdf->Output(null, \Mpdf\Output\Destination::STRING_RETURN);
    }

}
