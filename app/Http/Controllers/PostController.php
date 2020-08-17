<?php

/**
 * Class namespace
 */
namespace App\Http\Controllers;

/**
 * Used packages
 */
use App\Http\Requests\PostRequest;

/**
 * Post pdf file
 *
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * post file method
     *
     * @param PostRequest $request
     * @throws \Mpdf\MpdfException
     */
    public function post(PostRequest $request)
    {
        $name = time() . '_' .rand(0, 999) . '.pdf';
        $request->pdf->storeAs('pdf', $name);

        $pdfFileName = storage_path() . '/app/pdf/' . $name;
        $pdfPath = storage_path() . '/app/pdf/';

        $command = 'pdftohtml -enc UTF-8 -noframes ' . $pdfFileName . ' ' . $pdfPath . $name .'.html';

        $res = exec($command);

        $explodedByHead = explode('</head>', file_get_contents($pdfPath . $name .'.html'));
        $explodedByLines = explode("\n", $explodedByHead[1]);

        $newData = [];
        foreach ($explodedByLines as $key => $line) {
            if ($key == 2)
                $newData[] = '<Document>Some tag</Document>';

            $newData[] = $line;
        }

        $newData = $explodedByHead[0] . implode("\n", $newData);


        if (strpos($res, 'Page') !== false) {
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($newData);
            $mpdf->Output();
        }

        abort(420, 'It seems your pdf file is broken');
    }
}
