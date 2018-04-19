<?php

// needs fixing after the page resume is build!

require_once '../src/User/function.php';
$logo = '../../../../../../../../httpdocs/img/personicon.jpg';
$skills = '../../../../../../../../httpdocs/img/blackvalid.png';
var_dump($skills);

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
    $pdf->Image('../httpdocs/img/blackvalid.png', 60, 146, 5,'','','nickydevendt.nl','', false,300, '', false);
    $pdf->Image('../httpdocs/img/blackvalid.png', 60, 154, 5,'','','nickydevendt.nl','', false,300, '', false);
    $pdf->Image('../httpdocs/img/blackvalid.png', 60, 162, 5,'','','nickydevendt.nl','', false,300, '', false);

    $pdf->Image('../httpdocs/img/blackvalid.png', 70, 207, 10,'','','nickydevendt.nl','', false,300, '', false);//linksboven
    $pdf->Image('../httpdocs/img/blackvalid.png', 87, 207, 10,'','','nickydevendt.nl','', false,300, '', false);//2e boven links
    $pdf->Image('../httpdocs/img/blackvalid.png', 108, 207, 10,'','','nickydevendt.nl','', false,300, '', false);// 3e boven links
    $pdf->Image('../httpdocs/img/blackvalid.png', 128, 207, 10,'','','nickydevendt.nl','', false,300, '', false);// boven laatste
    $pdf->Image('../httpdocs/img/blackvalid.png', 70, 224, 10,'','','nickydevendt.nl','', false,300, '', false);//linker onder
    $pdf->Image('../httpdocs/img/blackvalid.png', 87, 224, 10,'','','nickydevendt.nl','', false,300, '', false);// 2e linker onder
    $pdf->Image('../httpdocs/img/blackvalid.png', 108, 224, 10,'','','nickydevendt.nl','', false,300, '', false);// 3e linker onder
    $pdf->Image('../httpdocs/img/blackvalid.png', 128, 224, 10,'','','nickydevendt.nl','', false,300, '', false);// 4e linker onder

    $html = '
        <style>
            .personalinfo {
                background-color: blue;
                text-align: right;
            }
            .workinfo {
                background-color: red;
            }
            .Education {
                float:right;
                width: 500;
            }
            .h1 {
                color: aqua;
            }
            .p {
                color: black;
            }
        </style>
        <html>
            <head></head>
            <body>
                <table class="" width="100%" cellpadding="0" border="0">
                    <tr>
                        <td class="personalinfo"width="25%">
                            <table width="100%" border="0">
                                <tr><td><b>Adres:</b></td></tr>
                                <tr><td>Ijsselstraat 45, 1972WB ijmuiden</td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>Phone number:</b></td></tr>
                                <tr><td>0615503959</td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>Email:</b></td></tr>
                                <tr><td>nickydevendt@hotmail.com</td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>Birth place:</b></td></tr>
                                <tr><td>Ijmuiden</td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>sex:</b></td></tr>
                                <tr><td>Male/Man</td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>Nationality:</b></td></tr>
                                <tr><td>Dutch/Nederlandse</td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>Drivers license:</b></td></tr>
                                <tr><td></td></tr>
                                <tr><td class="h1">Languages</td></tr>
                                <tr><td>English</td></tr>
                                <tr><td></td></tr>
                                <tr><td>Here will be placed round shapes one time</td></tr>
                                <tr><td></td></tr>
                                <tr><td>Dutch</td></tr>
                                <tr><td></td></tr>
                                <tr><td>HIER KOMEN BOLLETJES</td></tr>
                                <tr><td></td></tr>
                                <tr><td>Spanish</td></tr>
                                <tr><td></td></tr>
                                <tr><td>round shapes everywhere</td></tr>
                                <tr><td></td></tr>
                                <tr><td class="h1">Software skills</td></tr>
                                <tr><td></td></tr>
                                <tr><td>Word</td></tr>
                                <tr><td></td></tr>
                                <tr><td>Round shapes</td></tr>
                                <tr><td></td></tr>
                                <tr><td>PHP</td></tr>
                                <tr><td></td></tr>
                                <tr><td>Round shapes</td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td>Personality</td></tr>
                                <tr><td></td></tr>
                                <tr><td>Communicative</td></tr>
                                <tr><td>Punctuality</td></tr>
                                <tr><td>Creativity</td></tr>
                                <tr><td>Organized</td></tr>
                                <tr><td></td></tr>
                            </table>
                        </td>
                        <td width="5"></td>
                        <td class="workinfo" width="70%">
                            <table width="70%" border="0">
                                <tr><td class="h1"><b>Profile</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>Web oriented super motivated developer just out of school trying to make it in the big world. I am currently looking for a web developer job where I can show my skills and hone them gradually.</td></tr>
                                    <tr><td></td></tr>
                                <tr><td class="h1"><b>Education</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>2016 - 2018</td></tr>
                                    <tr><td><b>MBO 4 IT Application developer</b></td></tr>
                                    <tr><td>IT education about programming and giving the basics to the students so they can grow in future jobs.</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>feb 2015 - okt 2015</td></tr>
                                    <tr><td><b>MBO 2 IT collaborator</b></td></tr>
                                    <tr><td>A education about giving first line support to customers co-workers and alike.</td></tr>
                                    <tr><td></td></tr>
                                <tr><td class="h1">Experience</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>Jan 2018 - june 2018</td></tr>
                                    <tr><td>Sensimedia</td></tr>
                                    <tr><td>internship</td></tr>
                                    <tr>
                                        <td>I was here as a intern learning programming; Learned alot of different programming languages; honed my skills did mostly <b>HTML(Twig)</b>, <b>CSS</b>, <b>PHP</b>, a little bit of <b>jQuery</b> & <b>symfony</b></td>
                                        <td></td>
                                    </tr>
                                    <tr><td></td></tr>
                                <tr><td class="h1">Skills</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>data can go here</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>data can go here</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="h1">Certification</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>Certified in .....</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>Certified in .....</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>Certified in .....</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="h1">Hobbies</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <table>
                                            <tr>
                                                <td>Technology</td>
                                                <td>Gaming</td>
                                                <td>My dog</td>
                                                <td>Airsoft</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                            <tr>
                                                <td>Learning</td>
                                                <td>Motor riding </td>
                                                <td>Swimming</td>
                                                <td>Carpenting</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr>
                        <td>  Nulla tenaci infiat est via Nulla tenaci infiat est via Nulla tenaci infiat est via Nulla tenaci infiat est via Nulla tenaci infiat est via Nulla tenaci infiat est via Nulla tenaci infiat est via Nulla tenaci infiat est via Nulla tenaci infiat est viaNulla tenaci infiat est via</td>
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

