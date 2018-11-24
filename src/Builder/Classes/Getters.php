<?php

namespace Snono\PDFBuilder\Builder\Classes;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * This is the Setters trait.
 *
 * @author Yaser ghanawi
 *
 */
trait Getters
{
    /**
     * Get the CSS File name.
     *
     * @method getCssUrls
     *
     * @return string
     */
    public function getCssUrls()
    {

        return $this->_cssFiles;
    }

    /**
     * Get the  template blade .
     *
     * @method setTemplate
     *
     * @return string
     */
    public function getTemplate()
    {

        return  $this->_template;
    }

    /**
     * Get the  orientation pdf file.
     *
     * @method setOrientation
     *
     * @return string
     */
    public function getOrientation()
    {
        return $this->_orientation;
    }

    /**
     * Get the Directionality.
     *
     * @method setDirectionality
     *
     * @return string
     */
    public function getDirectionality()
    {
        return $this->_directionality;
    }

    /**
     * Get the Header template.
     *
     * @method setHeader
     *
     * @return string
     */
    public function getHeader()
    {
         return $this->_header;
    }

    /**
     * Get the Html Header template.
     *
     * @method setHtmlFooter
     *
     *
     * @return object
     */
    public function getHtmlHeader()
    {
        return $this->_htmlHeader;
    }


    /**
     * Get the Footer template.
     *
     * @method setFooter
     *
     * @return string
     */
    public function getFooter()
    {

        return $this->_footer;
    }

    /**
     * Get the Html Footer template.
     *
     * @method setHtmlFooter
     *
     * @return object
     */
    public function getHtmlFooter()
    {
        return  $this->_htmlFooter;
    }

    /**
     * Get the send it to specified destination.
     *
     * @method setDestination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->_destination;
    }


    /**
     * Get which languages are auto-detected.
     *
     * @method setAutoFont

     * @return string
     */
    public function getAutoFont()
    {

        return $this->_autoFon;
    }

    /**
     * Get the data report.
     *
     * @method setData
     *
     * @return Collection
     */
    public function getData()
    {
        return $this->_pdf_data;
    }

}
