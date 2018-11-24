<?php

namespace Snono\PDFBuilder\Builder\Classes;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * This is the Setters trait.
 *
 * @author Yaser ghanawi
 */
trait Setters
{
    /**
     * Set the CSS File name.
     *
     * @method setCssUrls
     *
     * @param string array($urls)
     *
     * @return self
     */
    public function setCssUrls($urls)
    {
        try {
            foreach ($urls as $url) {
//                $text = file_get_contents($url);
//                if (false === $text){
//                 throw new \Exception('Error get file content :' .$url);
//                }

                // proceed with your text, e.g. concatinating it:
                $this->_cssFiles .= Utility::file_get_contents_curl($url);
            }

        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
        return $this;
    }

    /**
     * Set the  template blade .
     *
     * @method setTemplate
     *
     * @param string $template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        $this->_template = $template;

        return $this;
    }

    /**
     * Set the  orientation pdf file.
     *
     * @method setOrientation
     *
     * @param string $orientation P|L
     *
     * @return self
     */
    public function setOrientation($orientation)
    {
        $this->_orientation = $orientation;

        return $this;
    }

    /**
     * Set the Directionality.
     *
     * @method setDirectionality
     *
     * @param string $dir rtl\ltr
     *
     * @return self
     */
    public function setDirectionality($dir)
    {
        $this->_directionality = $dir;

        return $this;
    }

    /**
     * Set the Header template.
     *
     * @method setHeader
     *
     * @param string $header
     *
     * @return self
     */
    public function setHeader($header)
    {
        $contents = explode('|', $header);
        $arr = array (
            'L' => array (
                'content' => isset($contents[0]) ? $contents[0] : '',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color'=>'#535759'
            ),
            'C' => array (
                'content' => isset($contents[1]) ? $contents[1] : '',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color'=>'#535759'
            ),
            'R' => array (
                'content' => isset($contents[2]) ? $contents[2] : '',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color'=>'#535759'
            ),
            'line' => 1,
        );
        $this->_header = $arr;

        return $this;
    }

    /**
     * Set the Html Header template.
     *
     * @method setHtmlFooter
     *
     * @param string $html
     * @param string $side ['O' - set the header for ODD pages    'E' - set the header for EVEN pages]
     *
     * @return self
     */
    public function setHtmlHeader($html, $side = '')
    {
        $this->_htmlHeader = (object) array('html' =>$html, 'side' => $side);

        return $this;
    }


    /**
     * Set the Footer template.
     *
     * @method setFooter
     *
     * @param string $footer
     *
     * @return self
     */
    public function setFooter($footer)
    {
        $contents = explode('|', $footer);
        Log::info(print_r($contents, true));
        $arr = array (
            'L' => array (
                'content' => isset($contents[0]) ? $contents[0] : '',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color'=>'#535759'
            ),
            'C' => array (
                'content' => isset($contents[1]) ? $contents[1] : '',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color'=>'#535759'
            ),
            'R' => array (
                'content' => isset($contents[2]) ? $contents[2] : '',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color'=>'#535759'
            ),
            'line' => 1,
        );
        $this->_footer = $arr;

        return $this;
    }

    /**
     * Set the Html Footer template.
     *
     * @method setHtmlFooter
     *
     * @param string $html
     * @param string $side ['O' - set the header for ODD pages    'E' - set the header for EVEN pages]
     * @param string $write [ if true it forces the Header to be written immediately to the current page. Use if the header is being set after the new page has been added.]
     *
     * @return self
     */
    public function setHtmlFooter($html, $side = '', $write = false)
    {
        $this->_htmlFooter = (object) array('html' =>$html , 'side' => $side, 'write' => $write);

        return $this;
    }

    /**
     * Set the send it to specified destination.
     *
     * @method setDestination
     *
     * @param string $destination I: Inline | D: Download | F: File | S: String Return
     *
     * @return self
     */
    public function setDestination($destination)
    {
        $this->_destination = $destination;

        return $this;
    }


    /**
     * Set which languages are auto-detected.
     *
     * @method setAutoFont
     *
     * @param int $details
     *   0 - Turn off any auto-detection
     *   AUTOFONT_CJK = 1 - Any CJK languages (Chinese - Japanese - Korean)
     *   AUTOFONT_THAIVIET = 2 - Thai and Vietnamese
     *   AUTOFONT_RTL = 4 - RTL languages i.e. Hebrew and Arabic, including Pashto, Urdu etc.
     *   AUTOFONT_INDIC = 8 - Indic languages such as Devanagari
     *   AUTOFONT_ALL = 15 - All of the above
     *   Default: AUTOFONT_ALL (15)
     * @return self
     */
    public function setAutoFont($details)
    {
        $this->_autoFont =$details;

        return $this;
    }

    /**
     * Set the data report.
     *
     * @method setData
     *
     * @param array $data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->_pdf_data =$data;

        return $this;
    }



    /**
     * Set the pdf currency.
     *
     * @method currency
     *
     * @param string $currency
     *
     * @return self
     */
    public function currency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

}
