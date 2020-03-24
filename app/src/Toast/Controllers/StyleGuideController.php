<?php

namespace Toast\Controllers;

use SilverStripe\Assets\File;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Security\Security;
use SilverStripe\View\ArrayData;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;
use SilverStripe\Assets\Image;
use SilverStripe\Versioned\Versioned;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;

class StyleGuideController extends Controller
{

    private static $url_segment = '_styleguide';

    private static $allowed_actions = [
        'index'
    ];

    public function init()
    {

        $image = File::find('Placeholder.jpg');

        if (!$image) {
            $file = Image::create();
            $file->setFromLocalFile('themes/mercury/dist/images/standard/Placeholder.jpg', 'Placeholder.jpg');
            $file->write();
            if (class_exists(Versioned::class)) {
                $file->copyVersionToStage(Versioned::DRAFT, Versioned::LIVE);
            }
        }

        parent::init();
    }

    public function TextBlock()
    {
        $arrayData = new ArrayData([
            'Content' => DBField::create_field(DBHTMLText::class, '<h5 class="colour--primary"><b>ALIQUAM TINCIDUNT</b></h5><h1 class="h2">Morbi in sem quis dui placerat ornare</h1><h6>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat.</h6><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>')
        ]);
        return $arrayData->renderWith('Toast\Blocks\Block');
    }


    public function index()
    {
        if (is_null(Security::getCurrentUser())) {
            return $this->redirect('Security/login?BackURL=_styleguide');
        } else {
            return $this->renderWith(['StyleGuideController', 'Page']);
        }
    }


    public function TestimonialBlock()
    {
        $accordionItems = new ArrayList([
            new ArrayData([
                'Testimonial' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'Attribution' => 'First name, Last Name',
            ]),
            new ArrayData([
                'Testimonial' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'Attribution' => 'First name, Last Name',
            ]),
            new ArrayData([
                'Testimonial' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'Attribution' => 'First name, Last Name',
            ]),
        ]);

        $arrayData = new ArrayData([
            'Testimonials' => $accordionItems
        ]);


        return $arrayData->renderWith('Toast\Blocks\TestimonialBlock');
    }

    public function VideoBlock()
    {
        $arrayData = new ArrayData([
            'VideoType' => 'youtube',
            'Video'     => 'ScMzIvxBSi4',
            'Caption'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, ipsum dolor sit amet.',
            'ThumbnailID' => 12,
            'Thumbnail' => Image::find('Placeholder.jpg')
        ]);
        return $arrayData->renderWith('Toast\Blocks\VideoBlock');
    }

    public function ImageBlock()
    {
        $arrayData = new ArrayData([
            'Image'   => Image::find('Placeholder.jpg'),
            'Caption' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, ipsum dolor sit amet.',
        ]);
        return $arrayData->renderWith('Toast\Blocks\ImageBlock');
    }


    public function ImageTextBlock()
    {
        $arrayData = new ArrayData([
            'Image'   => Image::find('Placeholder.jpg'),
            'Content'      => DBField::create_field(DBHTMLText::class, '<h3>Ipsum dolor sit</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p><a href="#" class="button">READ MORE</a></p>')
        ]);
        return $arrayData->renderWith('Toast\Blocks\ImageTextBlock');
    }


    public function ImageTextBlockReversed()
    {
        $arrayData = new ArrayData([
            'Image'   => Image::find('Placeholder.jpg'),
            'Content'      => DBField::create_field(DBHTMLText::class, '<h3>Adipiscing elit</h3><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p><a href="#" class="button">READ MORE</a></p>'),
            'ReverseLayout' => true
        ]);
        return $arrayData->renderWith('Toast\Blocks\ImageTextBlock');
    }

    public function AccordionBlock()
    {

        $accordionItems = new ArrayList([
            new ArrayData([
                'Title' => 'Accordion Heading 1',
                'Content'      => DBField::create_field(DBHTMLText::class, '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>')
            ]),
            new ArrayData([
                'Title' => 'Accordion Heading 2',
                'Content'      => DBField::create_field(DBHTMLText::class, '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>')
            ]),
            new ArrayData([
                'Title' => 'Accordion Heading 3',
                'Content'      => DBField::create_field(DBHTMLText::class, '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>')
            ]),
        ]);

        $arrayData = new ArrayData([
            'Items' => $accordionItems
        ]);

        return $arrayData->renderWith('Toast\Blocks\AccordionBlock');
    }



    public function DownloadBlock()
    {
        $files     = new ArrayList([
            new ArrayData([
                'File' => Image::find('Placeholder.jpg'),
            ]),
            new ArrayData([
                'File' => Image::find('Placeholder.jpg'),
            ]),
            new ArrayData([
                'File' => Image::find('Placeholder.jpg'),
            ])
        ]);
        $arrayData = new ArrayData([
            'Items' => $files
        ]);
        return $arrayData->renderWith('Toast\Blocks\DownloadBlock');
    }

    public function SplitBlock()
    {
        $arrayData = new ArrayData([
            'LeftContent'  => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'RightContent' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'LeftWidth'    => '200px',
            'RightWidth'   => '200px'
        ]);
        return $arrayData->renderWith('Toast\Blocks\SplitBlock');
    }

    public function getTags()
    {
        return  new ArrayList([
            new ArrayData(['Selector' => 'h1', 'Name' => 'Heading 1']),
            new ArrayData(['Selector' => 'h2', 'Name' => 'Heading 2']),
            new ArrayData(['Selector' => 'h3', 'Name' => 'Heading 3']),
            new ArrayData(['Selector' => 'h4', 'Name' => 'Heading 4']),
            new ArrayData(['Selector' => 'h5', 'Name' => 'Heading 5']),
            new ArrayData(['Selector' => 'h6', 'Name' => 'Heading 6']),
            new ArrayData(['Selector' => 'p', 'Name' => 'Paragraph'])
        ]);
    }
    public function appendSizeVariants($sValue)
    {
        return  $sValue . ':100,300,400,500,600,700,800,900';
    }

    public function decodedFonts()
    {
        $config = SiteConfig::current_site_config();
        return json_encode(array_map(array($this, 'appendSizeVariants'), array_values(array_unique(json_decode($config->typeFonts)))));
    }
}
