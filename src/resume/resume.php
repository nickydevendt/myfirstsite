<?php

// needs fixing after the page resume is build!

require_once '../src/User/function.php';
$logo = '../../../../../../../../httpdocs/img/lion.jpg';

if(isset($_POST['showResume'])) {
    pdfviewer($logo);
}


function getResume() {
    $userService = new UserService();
    $pdo = $userService->connection();

    $statement = $pdo->prepare('select id, usersid, unnest(educations) from resume where usersid = 1');
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function pdfviewer($logo) {
    // create new pdf document
    $pdf = new TCPDF_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicky de Vendt');
    $pdf->SetTitle('TCPDF Curriculum vitae');
    $pdf->SetSubject('TCPDF C.V.');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide, C.V., Curriculum vitae, resume');

    // set default header data
    $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, 'Curriculum vitae','by Nicky de Vendt - nickydevendt.nl',array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));

    // set header and footer font
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospace font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->SetFont('helvetica', '', 9);
    $pdf->AddPage();
    $html = '
        <style>
            .personalinfo {
                background-color: blue;
            }
            .Education {
                float:right;
                width: 500;
            }
            #row1 {
            }
        </style>
        <html>
            <head></head>
            <body>
                <table class="personalinfo" width="100%" cellpadding="0" border="0">
                    <tr>
                        <td width="20%">
                            <table width="100%" border="0">
                                <tr><td><b>Adres:</b></td></tr>
                                <tr><td>Ijsselstraat 45, 1972WB ijmuiden</td></tr>
                                <tr><td><b>Phone number:</b></td></tr>
                                <tr><td>0615503959</td></tr>
                                <tr><td><b>Email:</b></td></tr>
                                <tr><td>nickydevendt@hotmail.com</td></tr>
                                <tr><td><b>birth place ofzo</b></td></tr>
                                <tr><td>Data can go here</td></tr>
                            </table>
                        </td>
                        <td width="60%">
                            <table width="100%" border="0">
                                <tr><td>data can go here</td></tr>
                            </table>
                        </td>
                        <td width="20%">
                            <table width="100%" border="0">
                                <tr><td>data can go here</td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
    ';
    $pdf->writeHTML($html, true, 0, true, 0);
    $pdf->lastPage();
    ob_end_clean();
    $pdf->Output('NickydeVendt.pdf', 'I');

    // its working needs finetuning
}

