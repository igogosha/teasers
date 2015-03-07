<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlockSettings
 *
 * @ORM\Table(name="block_settings")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BlockSettingsRepository")
 */
class BlockSettings
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="block_name", type="string", length=255)
     */
    private $blockName;

    /**
     * @var integer
     *
     * @ORM\Column(name="rows", type="integer")
     */
    private $rows;

    /**
     * @var integer
     *
     * @ORM\Column(name="cols", type="integer")
     */
    private $cols;

    /**
     * @var string
     *
     * @ORM\Column(name="text_position", type="string", columnDefinition="enum('top', 'bottom', 'left', 'right')")
     */
    private $textPosition;

    /**
     * @var string
     *
     * @ORM\Column(name="background", type="string", length=255)
     */
    private $background;

    /**
     * @var integer
     *
     * @ORM\Column(name="padding", type="integer")
     */
    private $padding;

    /**
     * @var integer
     *
     * @ORM\Column(name="picture_size", type="integer")
     */
    private $pictureSize;

    /**
     * @var integer
     *
     * @ORM\Column(name="picture_border_radius", type="integer")
     */
    private $pictureBorderRadius;

    /**
     * @var integer
     *
     * @ORM\Column(name="picture_shadow_size", type="integer")
     */
    private $pictureShadowSize;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_shadow_color", type="string", length=255)
     */
    private $pictureShadowColor;

    /**
     * @var integer
     *
     * @ORM\Column(name="picture_border_size", type="integer")
     */
    private $pictureBorderSize;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_border_color", type="string", length=255)
     */
    private $pictureBorderColor;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_align_hor", type="string", length=255, columnDefinition="enum('left', 'center', 'right')")
     */
    private $pictureAlignHor;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_align_ver", type="string", length=255, columnDefinition="enum('top', 'middle', 'bottom')")
     */
    private $pictureAlignVer;

    /**
     * @var string
     *
     * @ORM\Column(name="header_font_family", type="string", length=255, columnDefinition="enum('Arial', 'Times New Roman', 'Verdana', 'serif', 'Tahoma')")
     */
    private $headerFontFamily;

    /**
     * @var integer
     *
     * @ORM\Column(name="header_font_size", type="integer")
     */
    private $headerFontSize;

    /**
     * @var string
     *
     * @ORM\Column(name="header_font_color", type="string", length=255)
     */
    private $headerFontColor;

    /**
     * @var string
     *
     * @ORM\Column(name="header_align_hor", type="string", length=255, columnDefinition="enum('left', 'center', 'right')")
     */
    private $headerAlignHor;

    /**
     * @var string
     *
     * @ORM\Column(name="header_align_ver", type="string", length=255, columnDefinition="enum('top', 'middle', 'bottom')")
     */
    private $headerAlignVer;

    /**
     * @var string
     *
     * @ORM\Column(name="header_font_style", type="string", length=255, columnDefinition="enum('underline', 'bold', 'italic')")
     */
    private $headerFontStyle;

    /**
     * @var string
     *
     * @ORM\Column(name="header_font_hover_color", type="string", length=255)
     */
    private $headerFontHoverColor;

    /**
     * @var string
     *
     * @ORM\Column(name="header_font_hover_style", type="string", length=255, columnDefinition="enum('underline', 'bold', 'italic')")
     */
    private $headerFontHoverStyle;

    /**
     * @var integer
     *
     * @ORM\Column(name="more_active", type="integer")
     */
    private $moreActive;

    /**
     * @var string
     *
     * @ORM\Column(name="more_type", type="string", length=255, columnDefinition="enum('txt', 'btn')")
     */
    private $moreType;

    /**
     * @var string
     *
     * @ORM\Column(name="more_txt", type="string", length=255)
     */
    private $moreTxt;

    /**
     * @var string
     *
     * @ORM\Column(name="more_image", type="string", length=255)
     */
    private $moreImage;

    /**
     * @var string
     *
     * @ORM\Column(name="more_position", type="string", length=255, columnDefinition="enum('up', 'down', 'img_up', 'img_down', 'left_up', 'left_down', 'right_up', 'right_down')")
     */
    private $morePosition;

    /**
     * @var string
     *
     * @ORM\Column(name="more_btn_align_hor", type="string", length=255, columnDefinition="enum('left', 'center', 'right')")
     */
    private $moreBtnAlignHor;

    /**
     * @var string
     *
     * @ORM\Column(name="more_btn_align_ver", type="string", length=255, columnDefinition="enum('top', 'middle', 'bottom')")
     */
    private $moreBtnAlignVer;

    /**
     * @var string
     *
     * @ORM\Column(name="more_txt_font", type="string", length=255, columnDefinition="enum('Arial', 'Times New Roman', 'Verdana', 'serif', 'Tahoma')")
     */
    private $moreTxtFont;

    /**
     * @var integer
     *
     * @ORM\Column(name="more_txt_font_size", type="integer")
     */
    private $moreTxtFontSize;

    /**
     * @var string
     *
     * @ORM\Column(name="more_txt_font_color", type="string", length=255)
     */
    private $moreTxtFontColor;

    /**
     * @var string
     *
     * @ORM\Column(name="more_txt_font_style", type="string", length=255, columnDefinition="enum('underline', 'bold', 'italic')")
     */
    private $moreTxtFontStyle;

    /**
     * @var string
     *
     * @ORM\Column(name="more_txt_font_hover_color", type="string", length=255)
     */
    private $moreTxtFontHoverColor;

    /**
     * @var string
     *
     * @ORM\Column(name="more_txt_font_hover_style", type="string", length=255, columnDefinition="enum('underline', 'bold', 'italic')")
     */
    private $moreTxtFontHoverStyle;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set blockName
     *
     * @param string $blockName
     * @return BlockSettings
     */
    public function setBlockName($blockName)
    {
        $this->blockName = $blockName;

        return $this;
    }

    /**
     * Get blockName
     *
     * @return string 
     */
    public function getBlockName()
    {
        return $this->blockName;
    }

    /**
     * Set rows
     *
     * @param integer $rows
     * @return BlockSettings
     */
    public function setRows($rows)
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * Get rows
     *
     * @return integer 
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Set cols
     *
     * @param integer $cols
     * @return BlockSettings
     */
    public function setCols($cols)
    {
        $this->cols = $cols;

        return $this;
    }

    /**
     * Get cols
     *
     * @return integer 
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * Set textPosition
     *
     * @param array $textPosition
     * @return BlockSettings
     */
    public function setTextPosition($textPosition)
    {
        $this->textPosition = $textPosition;

        return $this;
    }

    /**
     * Get textPosition
     *
     * @return array 
     */
    public function getTextPosition()
    {
        return $this->textPosition;
    }

    /**
     * Set background
     *
     * @param string $background
     * @return BlockSettings
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string 
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set padding
     *
     * @param integer $padding
     * @return BlockSettings
     */
    public function setPadding($padding)
    {
        $this->padding = $padding;

        return $this;
    }

    /**
     * Get padding
     *
     * @return integer 
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * Set pictureSize
     *
     * @param integer $pictureSize
     * @return BlockSettings
     */
    public function setPictureSize($pictureSize)
    {
        $this->pictureSize = $pictureSize;

        return $this;
    }

    /**
     * Get pictureSize
     *
     * @return integer 
     */
    public function getPictureSize()
    {
        return $this->pictureSize;
    }

    /**
     * Set pictureBorderRadius
     *
     * @param integer $pictureBorderRadius
     * @return BlockSettings
     */
    public function setPictureBorderRadius($pictureBorderRadius)
    {
        $this->pictureBorderRadius = $pictureBorderRadius;

        return $this;
    }

    /**
     * Get pictureBorderRadius
     *
     * @return integer 
     */
    public function getPictureBorderRadius()
    {
        return $this->pictureBorderRadius;
    }

    /**
     * Set pictureShadowSize
     *
     * @param integer $pictureShadowSize
     * @return BlockSettings
     */
    public function setPictureShadowSize($pictureShadowSize)
    {
        $this->pictureShadowSize = $pictureShadowSize;

        return $this;
    }

    /**
     * Get pictureShadowSize
     *
     * @return integer 
     */
    public function getPictureShadowSize()
    {
        return $this->pictureShadowSize;
    }

    /**
     * Set pictureShadowColor
     *
     * @param string $pictureShadowColor
     * @return BlockSettings
     */
    public function setPictureShadowColor($pictureShadowColor)
    {
        $this->pictureShadowColor = $pictureShadowColor;

        return $this;
    }

    /**
     * Get pictureShadowColor
     *
     * @return string 
     */
    public function getPictureShadowColor()
    {
        return $this->pictureShadowColor;
    }

    /**
     * Set pictureBorderSize
     *
     * @param integer $pictureBorderSize
     * @return BlockSettings
     */
    public function setPictureBorderSize($pictureBorderSize)
    {
        $this->pictureBorderSize = $pictureBorderSize;

        return $this;
    }

    /**
     * Get pictureBorderSize
     *
     * @return integer 
     */
    public function getPictureBorderSize()
    {
        return $this->pictureBorderSize;
    }

    /**
     * Set pictureBorderColor
     *
     * @param string $pictureBorderColor
     * @return BlockSettings
     */
    public function setPictureBorderColor($pictureBorderColor)
    {
        $this->pictureBorderColor = $pictureBorderColor;

        return $this;
    }

    /**
     * Get pictureBorderColor
     *
     * @return string
     */
    public function getPictureBorderColor()
    {
        return $this->pictureBorderColor;
    }

    /**
     * Set pictureAlignHor
     *
     * @param string $pictureAlignHor
     * @return BlockSettings
     */
    public function setPictureAlignHor($pictureAlignHor)
    {
        $this->pictureAlignHor = $pictureAlignHor;

        return $this;
    }

    /**
     * Get pictureAlignHor
     *
     * @return string 
     */
    public function getPictureAlignHor()
    {
        return $this->pictureAlignHor;
    }

    /**
     * Set pictureAlignVer
     *
     * @param string $pictureAlignVer
     * @return BlockSettings
     */
    public function setPictureAlignVer($pictureAlignVer)
    {
        $this->pictureAlignVer = $pictureAlignVer;

        return $this;
    }

    /**
     * Get pictureAlignVer
     *
     * @return string 
     */
    public function getPictureAlignVer()
    {
        return $this->pictureAlignVer;
    }

    /**
     * Set headerFontFamily
     *
     * @param string $headerFontFamily
     * @return BlockSettings
     */
    public function setHeaderFontFamily($headerFontFamily)
    {
        $this->headerFontFamily = $headerFontFamily;

        return $this;
    }

    /**
     * Get headerFontFamily
     *
     * @return string 
     */
    public function getHeaderFontFamily()
    {
        return $this->headerFontFamily;
    }

    /**
     * Set headerFontSize
     *
     * @param integer $headerFontSize
     * @return BlockSettings
     */
    public function setHeaderFontSize($headerFontSize)
    {
        $this->headerFontSize = $headerFontSize;

        return $this;
    }

    /**
     * Get headerFontSize
     *
     * @return integer 
     */
    public function getHeaderFontSize()
    {
        return $this->headerFontSize;
    }

    /**
     * Set headerFontColor
     *
     * @param string $headerFontColor
     * @return BlockSettings
     */
    public function setHeaderFontColor($headerFontColor)
    {
        $this->headerFontColor = $headerFontColor;

        return $this;
    }

    /**
     * Get headerFontColor
     *
     * @return string 
     */
    public function getHeaderFontColor()
    {
        return $this->headerFontColor;
    }

    /**
     * Set headerAlignHor
     *
     * @param string $headerAlignHor
     * @return BlockSettings
     */
    public function setHeaderAlignHor($headerAlignHor)
    {
        $this->headerAlignHor = $headerAlignHor;

        return $this;
    }

    /**
     * Get headerAlignHor
     *
     * @return string 
     */
    public function getHeaderAlignHor()
    {
        return $this->headerAlignHor;
    }

    /**
     * Set headerAlignVer
     *
     * @param string $headerAlignVer
     * @return BlockSettings
     */
    public function setHeaderAlignVer($headerAlignVer)
    {
        $this->headerAlignVer = $headerAlignVer;

        return $this;
    }

    /**
     * Get headerAlignVer
     *
     * @return string 
     */
    public function getHeaderAlignVer()
    {
        return $this->headerAlignVer;
    }

    /**
     * Set headerFontStyle
     *
     * @param string $headerFontStyle
     * @return BlockSettings
     */
    public function setHeaderFontStyle($headerFontStyle)
    {
        $this->headerFontStyle = $headerFontStyle;

        return $this;
    }

    /**
     * Get headerFontStyle
     *
     * @return string 
     */
    public function getHeaderFontStyle()
    {
        return $this->headerFontStyle;
    }

    /**
     * Set headerFontHoverColor
     *
     * @param string $headerFontHoverColor
     * @return BlockSettings
     */
    public function setHeaderFontHoverColor($headerFontHoverColor)
    {
        $this->headerFontHoverColor = $headerFontHoverColor;

        return $this;
    }

    /**
     * Get headerFontHoverColor
     *
     * @return string 
     */
    public function getHeaderFontHoverColor()
    {
        return $this->headerFontHoverColor;
    }

    /**
     * Set headerFontHoverStyle
     *
     * @param string $headerFontHoverStyle
     * @return BlockSettings
     */
    public function setHeaderFontHoverStyle($headerFontHoverStyle)
    {
        $this->headerFontHoverStyle = $headerFontHoverStyle;

        return $this;
    }

    /**
     * Get headerFontHoverStyle
     *
     * @return string 
     */
    public function getHeaderFontHoverStyle()
    {
        return $this->headerFontHoverStyle;
    }

    /**
     * Set moreActive
     *
     * @param integer $moreActive
     * @return BlockSettings
     */
    public function setMoreActive($moreActive)
    {
        $this->moreActive = $moreActive;

        return $this;
    }

    /**
     * Get moreActive
     *
     * @return integer 
     */
    public function getMoreActive()
    {
        return $this->moreActive;
    }

    /**
     * Set moreType
     *
     * @param string $moreType
     * @return BlockSettings
     */
    public function setMoreType($moreType)
    {
        $this->moreType = $moreType;

        return $this;
    }

    /**
     * Get moreType
     *
     * @return string 
     */
    public function getMoreType()
    {
        return $this->moreType;
    }

    /**
     * Set moreTxt
     *
     * @param string $moreTxt
     * @return BlockSettings
     */
    public function setMoreTxt($moreTxt)
    {
        $this->moreTxt = $moreTxt;

        return $this;
    }

    /**
     * Get moreTxt
     *
     * @return string 
     */
    public function getMoreTxt()
    {
        return $this->moreTxt;
    }

    /**
     * Set moreImage
     *
     * @param string $moreImage
     * @return BlockSettings
     */
    public function setMoreImage($moreImage)
    {
        $this->moreImage = $moreImage;

        return $this;
    }

    /**
     * Get moreImage
     *
     * @return string 
     */
    public function getMoreImage()
    {
        return $this->moreImage;
    }

    /**
     * Set morePosition
     *
     * @param string $morePosition
     * @return BlockSettings
     */
    public function setMorePosition($morePosition)
    {
        $this->morePosition = $morePosition;

        return $this;
    }

    /**
     * Get morePosition
     *
     * @return string 
     */
    public function getMorePosition()
    {
        return $this->morePosition;
    }

    /**
     * Set moreBtnAlignHor
     *
     * @param string $moreBtnAlignHor
     * @return BlockSettings
     */
    public function setMoreBtnAlignHor($moreBtnAlignHor)
    {
        $this->moreBtnAlignHor = $moreBtnAlignHor;

        return $this;
    }

    /**
     * Get moreBtnAlignHor
     *
     * @return string 
     */
    public function getMoreBtnAlignHor()
    {
        return $this->moreBtnAlignHor;
    }

    /**
     * Set moreBtnAlignVer
     *
     * @param string $moreBtnAlignVer
     * @return BlockSettings
     */
    public function setMoreBtnAlignVer($moreBtnAlignVer)
    {
        $this->moreBtnAlignVer = $moreBtnAlignVer;

        return $this;
    }

    /**
     * Get moreBtnAlignVer
     *
     * @return string 
     */
    public function getMoreBtnAlignVer()
    {
        return $this->moreBtnAlignVer;
    }

    /**
     * Set moreTxtFont
     *
     * @param string $moreTxtFont
     * @return BlockSettings
     */
    public function setMoreTxtFont($moreTxtFont)
    {
        $this->moreTxtFont = $moreTxtFont;

        return $this;
    }

    /**
     * Get moreTxtFont
     *
     * @return string 
     */
    public function getMoreTxtFont()
    {
        return $this->moreTxtFont;
    }

    /**
     * Set moreTxtFontSize
     *
     * @param integer $moreTxtFontSize
     * @return BlockSettings
     */
    public function setMoreTxtFontSize($moreTxtFontSize)
    {
        $this->moreTxtFontSize = $moreTxtFontSize;

        return $this;
    }

    /**
     * Get moreTxtFontSize
     *
     * @return integer 
     */
    public function getMoreTxtFontSize()
    {
        return $this->moreTxtFontSize;
    }

    /**
     * Set moreTxtFontColor
     *
     * @param string $moreTxtFontColor
     * @return BlockSettings
     */
    public function setMoreTxtFontColor($moreTxtFontColor)
    {
        $this->moreTxtFontColor = $moreTxtFontColor;

        return $this;
    }

    /**
     * Get moreTxtFontColor
     *
     * @return string 
     */
    public function getMoreTxtFontColor()
    {
        return $this->moreTxtFontColor;
    }

    /**
     * Set moreTxtFontStyle
     *
     * @param string $moreTxtFontStyle
     * @return BlockSettings
     */
    public function setMoreTxtFontStyle($moreTxtFontStyle)
    {
        $this->moreTxtFontStyle = $moreTxtFontStyle;

        return $this;
    }

    /**
     * Get moreTxtFontStyle
     *
     * @return string 
     */
    public function getMoreTxtFontStyle()
    {
        return $this->moreTxtFontStyle;
    }

    /**
     * Set moreTxtFontHoverColor
     *
     * @param string $moreTxtFontHoverColor
     * @return BlockSettings
     */
    public function setMoreTxtFontHoverColor($moreTxtFontHoverColor)
    {
        $this->moreTxtFontHoverColor = $moreTxtFontHoverColor;

        return $this;
    }

    /**
     * Get moreTxtFontHoverColor
     *
     * @return string 
     */
    public function getMoreTxtFontHoverColor()
    {
        return $this->moreTxtFontHoverColor;
    }

    /**
     * Set moreTxtFontHoverStyle
     *
     * @param string $moreTxtFontHoverStyle
     * @return BlockSettings
     */
    public function setMoreTxtFontHoverStyle($moreTxtFontHoverStyle)
    {
        $this->moreTxtFontHoverStyle = $moreTxtFontHoverStyle;

        return $this;
    }

    /**
     * Get moreTxtFontHoverStyle
     *
     * @return string 
     */
    public function getMoreTxtFontHoverStyle()
    {
        return $this->moreTxtFontHoverStyle;
    }
}
