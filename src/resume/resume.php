<?php

// needs fixing after the page resume is build!

require_once '../src/User/function.php';
//require_once 'tcpdf_include.php';

function getResume() {
    $userService = new UserService();
    $pdo = $userService->connection();

    $statement = $pdo->prepare('select id, usersid, unnest(educations) from resume where usersid = 1');
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function pdfviewer() {
    $pdf = new TCPDF_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->SetFont('helvetica', '', 9);
    $pdf->AddPage();
    $html = '<html>
    <head></head>
    <body><table border="1">
    <tr><th>Name</th>
    <th>Company</th></tr>
    <tr>
    <td>Hi im Nicky de Vendt</td>
    <td> working on a pdf generated file!</td>
    </tr>
    </table>
    </body>
    </html>';
    $pdf->writeHTML($html, true, 0, true, 0);
    $pdf->lastPage();
    $pdf->Output('resume.pdf', 'I');

    // its working needs finetuning
}

