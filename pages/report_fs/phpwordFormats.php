<?php
//require_once 'C:\xampp\htdocs\phpWordsItp\vendor\autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
//Default font style
$phpWord->setDefaultFontName('Arial');
$phpWord->setDefaultFontSize(11);

//Create font style
$fontStyleBigBlack = 'ArialBlack14';
$fontStyleBlack = 'ArialBlack11';
$fontstyleName = 'Arial11';
$fontstyleUnderline = 'Arial11Underline';
$fontstyleBottomUnderline = 'TableUnderline';
$fontStyleItalic = 'Arial11Italic';

$phpWord->addFontStyle($fontStyleBigBlack, array('name' => 'Arial', 'size' => 14, 'bold' => true)
);
$phpWord->addFontStyle($fontStyleBlack, array('name' => 'Arial', 'size' => 11, 'bold' => true)
);
$phpWord->addFontStyle($fontstyleName, array('name' => 'Arial', 'size' => 11, 'bold' => false)
);
$phpWord->addFontStyle($fontstyleBottomUnderline, array('name' => 'Arial', 'size' => 11, 'bold' => false, 'underline' => 'single')
);
$phpWord->addFontStyle($fontStyleItalic, array('name' => 'Arial', 'size' => 11, 'bold' => false, 'italic' => true));


$centerAlignment = array('align' => 'center', 'spaceAfter' => 0);
$noSpace = array('spaceAfter' => 0);
$cellBottomBorder = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000');
$cellThickBottomBorder = array('borderBottomSize' => 18, 'borderBottomColor' => '#000000');
$cellTopBorder = array('borderTopSize' => 1, 'borderBottomColor' => '#000000');
$topAndBottom = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderBottomSize' => 18, 'borderBottomColor' => '#000000');
$cellTopAndBottomNormal = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderBottomSize' => 1, 'borderBottomColor' => '#000000');
$borderTopAndLeft = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000');
$borderTopAndRight = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000');
$borderTop = array('borderTopSize' => 1, 'borderTopColor' => '#000000');
$borderLeft = array('borderLeftSize' => 1, 'borderLeftColor' => '#000000');
$borderRight = array('borderRightSize' => 1, 'borderRightColor' => '#000000');
$borderBottomAndLeft = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000');
$borderBottomAndRight = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000');
$allBorders = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000', 'borderBottomSize' => 1, 'borderBottomColor' => '#000000');
$borderTopLeftRight = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000', 'borderRightColor' => '#000000', 'borderRightSize' => 1);
$borderLeftRight = array('borderLeftSize' => 1, 'borderLeftColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000');
$borderLeftRightBottom = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000', 'borderRightColor' => '#000000', 'borderRightSize' => 1);

//Create listing style
$listingStyle = 'multilevel';
$phpWord->addNumberingStyle(
        $listingStyle, array(
    'type' => 'multilevel',
    'levels' => array(
        array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
        array('format' => 'lowerRoman', 'text' => '(%2)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerLetter', 'text' => '%3)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerLetter', 'text' => '(%4)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerLetter', 'text' => '(%5)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerLetter', 'text' => '(%6)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerLetter', 'text' => '(%7)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720, 'start' => 14),
        array('format' => 'lowerLetter', 'text' => '(%8)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720, 'start' => 9),
        array('format' => 'lowerLetter', 'text' => '(%9)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720)
    )
        )
);

$nestedListStyle = 'nestedlevel';
$phpWord->addNumberingStyle(
        $nestedListStyle, array(
    'type' => 'multilevel',
    'levels' => array(
        array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 1),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
    )
        )
);

$romanListingStyle = 'romanlevel';
$phpWord->addNumberingStyle(
        $romanListingStyle, array(
    'type' => 'multilevel',
    'levels' => array(
        array('format' => 'lowerRoman', 'text' => '(%1)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerRoman', 'text' => '(%2)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerRoman', 'text' => '(%3)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerRoman', 'text' => '(%4)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerRoman', 'text' => '(%5)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerRoman', 'text' => '(%6)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
        array('format' => 'lowerRoman', 'text' => '(%7)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
    )
        )
);

// Phoebe's style
$phpWord->addFontStyle('myOwnStyle', array('color' => 'FF0000'));
$phpWord->addParagraphStyle('P-Style', array('spaceAfter' => 95));
$phpWord->addNumberingStyle(
        'multilevel', array(
    'type' => 'multilevel',
    'levels' => array(
        array('format' => 'decimal', 'text' => '%8.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
        array('format' => 'upperLetter', 'text' => '%9.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
    ),
        )
);
$predefinedMultilevel = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED);

//Create Paragraph style
$paragraphStyle = 'justifiedParagraph';
$phpWord->addParagraphStyle($paragraphStyle, array('align' => 'both', 'spaceAfter' => 100));
?>
