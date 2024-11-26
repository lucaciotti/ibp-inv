<?php
namespace App\Helpers;

use PDF;

class PdfReport
{
    public static function A4Portrait($view, $data, $title, $subTitle){

        $pdf = PDF::loadView($view, $data)
            ->setOption('header-html', view('mcslide._exports.pdf._masterPage.headerPdf', ['pageTitle' => $title, 'pageSubTitle' => $subTitle]))
            ->setOption('footer-html', view('mcslide._exports.pdf._masterPage.footerPdf'))
            ->setOption('enable-local-file-access', true)
            ->setPaper('a4');

        return $pdf;
    }

    public static function A4Landscape($view, $data, $title, $subTitle){

        $pdf = PDF::loadView($view, $data)
            ->setOption('header-html', view('mcslide._exports.pdf._masterPage.headerPdf', ['pageTitle' => $title, 'pageSubTitle' => $subTitle]))
            ->setOption('footer-html', view('mcslide._exports.pdf._masterPage.footerPdf'))
            ->setOption('enable-local-file-access', true)
            ->setOption('orientation', 'Landscape')
            ->setPaper('a4');

        return $pdf;
    }
    
        /* ->setOption('enable-javascript', true)
        ->setOption('javascript-delay', 13500)
        ->setOption('enable-smart-shrinking', true)
        ->setOption('no-stop-slow-scripts', true) */
}