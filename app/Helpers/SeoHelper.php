<?php

namespace App\Helpers;

use Artesaos\SEOTools\Facades\SEOTools;

class SeoHelper
{
    /**
     * SEO settings for the homepage
     */
    public static function forHome(): void
    {
        SEOTools::setTitle('فروشگاه اینترنتی مارکت پرو | خرید آنلاین محصولات اورجینال با بهترین قیمت');
        SEOTools::setDescription(
            'فروشگاه اینترنتی مارکت پرو ارائه‌دهنده انواع محصولات با تضمین اصالت کالا، بهترین قیمت و ارسال سریع به سراسر ایران.'
        );

        SEOTools::metatags()->setKeywords([
            'خرید اینترنتی',
            'فروشگاه آنلاین',
            'محصولات اصل',
            'ارسال سریع',
            'قیمت مناسب'
        ]);

        SEOTools::setCanonical(url('/'));

        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->setTitle('فروشگاه اینترنتی مارکت پرو');
        SEOTools::opengraph()->setDescription('خرید اینترنتی انواع محصولات با بهترین قیمت و ارسال سریع.');
        SEOTools::opengraph()->addImage(asset('images/cover.jpg'));

        SEOTools::twitter()->setTitle('فروشگاه اینترنتی مارکت پرو');
        SEOTools::twitter()->setSite('@yourstore');
        SEOTools::twitter()->setDescription('خرید اینترنتی انواع محصولات با بهترین قیمت و ارسال سریع.');
        SEOTools::twitter()->setImage(asset('images/cover.jpg'));

        SEOTools::jsonLd()->setType('Store');
        SEOTools::jsonLd()->setTitle('فروشگاه اینترنتی مارکت پرو');
        SEOTools::jsonLd()->setDescription('خرید اینترنتی انواع محصولات با بهترین قیمت و ارسال سریع.');
        SEOTools::jsonLd()->addImage(asset('images/cover.jpg'));
        SEOTools::jsonLd()->addValues([
            "url" => url('/'),
            "logo" => asset('images/logo.png'),
            "telephone" => "+982112345678",
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => "خیابان مثال",
                "addressLocality" => "تهران",
                "addressCountry" => "ایران"
            ],
            "openingHours" => "Mo-Sa 09:00-21:00"
        ]);
    }

    /**
     * SEO settings for public pages (customizable)
     */
    public static function forPage($title, $description, $url = null, $image = null): void
    {
        $url = $url ?? url()->current();
        $image = $image ?? asset('images/cover.jpg');

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::setCanonical($url);

        SEOTools::opengraph()->setUrl($url);
        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->setDescription($description);
        SEOTools::opengraph()->addImage($image);

        SEOTools::twitter()->setTitle($title);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setImage($image);

        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setDescription($description);
        SEOTools::jsonLd()->addImage($image);
    }
}
