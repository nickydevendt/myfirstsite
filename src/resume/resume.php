<?php

// needs fixing after the page resume is build!

require_once '../src/User/function.php';

$pdfdir = dirname(__DIR__, 2). '/generatedpdf/';

if(isset($_POST['nlpdf'])) {
    $file = dirname(__DIR__,2) . '/generatedpdf/' . 'nl-nickydevendt.pdf';

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
    if(!file_exists($file)) {
        $message =  '<div class="alert">
            <span class="closebtn">&times;</span>
                    <strong>Error</strong> Dutch pdf couldnt load in try again or get in contact with the admin!
            </div>';
        echo $message;

    }
}

if(isset($_POST['ukpdf'])) {
    $file = dirname(__DIR__,2) . '/generatedpdf/' . 'nickydevendt.pdf';

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
    if(!file_exists($file)) {
        $message =  '<div class="alert">
            <span class="closebtn">&times;</span>
                    <strong>Error</strong> English pdf couldnt load in try again or get in contact with the admin
            </div>';
        echo $message;
    }
}

if(isset($_POST['germanpdf'])) {
    $file = dirname(__DIR__,2) . '/generatedpdf/' . 'ger-nickydevendt.pdf';

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
    if(!file_exists($file)) {
        $message =  '<div class="alert">
                <span class="closebtn">&times;</span>
                        <strong>Error</strong> pdf could not be created try again or send the admin a email he can fix it!
                    </div>';
        echo $message;
    }
}

function getResume() {
    $userService = new UserService();
    $pdo = $userService->connection();

    $statement = $pdo->prepare('select id, usersid, unnest(educations) from resume where usersid = 1');
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function pdfcreator($pdfname) {
    // create new pdf document
    $pdf = new TCPDF_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->SetFont('helvetica', '', 9);

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage();

    $html = '
        <style>
            .personalinfo {
                background-color: none;
                text-align: right;
            }
            .workinfo {
                background-color: none;
            }
            .Education {
                float:right;
                width: 500;
            }
            .h1 {
                color: #22a0dd;
            }
            .p {
                color: black;
            }
            .educom {
                color: gray;
            }
            .img {
                height: 15;
                width: 15;
            }
            .centerline {
                background-color: #d3cfcf;
            }
        </style>
        <html>
            <head></head>
            <body>
                <table class="" width="100%" cellpadding="0" border="0">
                    <tr>
                        <td class="personalinfo"width="24%">
                            <table width="100%" border="0">
                                <tr>
                                    <td>
                                        <table>
                                            <tr width="100%">
                                                <td width="97%"><img class="img" src="../httpdocs/img/personicon.jpg"  width="80" height="80"></td>
                                                <td width="3%"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td><b>Nicky de Vendt</b></td></tr>
                                <tr><td></td></tr>
                                <tr width="100">
                                    <td width="100">Ijsselstraat 45<br> 1972WB ijmuiden</td>
                                    <td><img class="img" src="../httpdocs/img/home.png" width="15" height="15"></td>
                                </tr>
                                <tr><td></td></tr>
                                <tr width="100">
                                    <td width="100"><br>22-07-1994</td>
                                    <td><img class="img" src="../httpdocs/img/cake.png"  width="15" height="12"></td>
                                </tr>
                                <tr><td></td></tr>
                                <tr width="100">
                                    <td width="100">
                                        0615503959<br>
                                        nickydevendt@hotmail.com
                                    </td>
                                    <td><img class="img" src="../httpdocs/img/contact.png"  width="15" height="15"></td>
                                </tr>
                            </table>
                            <table>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td class="h1"><b>Languages</b></td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>English</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td><b>Dutch</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td><b>German</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td><b>Spanish</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td class="h1"><b>Software skills</b></td></tr>
                                <tr><td></td></tr>
                                <tr><td><b>HTML & CSS</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td><b>PHP</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td><b>DBO</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td><b>Symfony</b></td></tr>
                                <tr>
                                    <td>
                                        <img class="img" src="../httpdocs/img/blackcircle.png"  width="12" height="12">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                        <img class="img" src="../httpdocs/img/whitecircle.png"  width="13" height="13">
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td class="h1"><b>Personality</b></td></tr>
                                <tr><td></td></tr>
                                <tr><td>Communicative<img class="img" src="../httpdocs/img/bvalid.png"  width="10" height="10"></td></tr>
                                <tr><td>Punctuality<img class="img" src="../httpdocs/img/bvalid.png"  width="10" height="10"></td></tr>
                                <tr><td>Creativity<img class="img" src="../httpdocs/img/bvalid.png"  width="10" height="10"></td></tr>
                                <tr><td>Organized<img class="img" src="../httpdocs/img/bvalid.png"  width="10" height="10"></td></tr>
                                <tr><td>Go-getter<img class="img" src="../httpdocs/img/bvalid.png"  width="10" height="10"></td></tr>
                                <tr><td></td></tr>
                            </table>
                        </td>
                        <td width="2%"></td>
                        <td class="centerline" width="2"></td>
                        <td width="2%"></td>
                        <td class="workinfo" width="70%">
                            <table width="70%" border="0">
                                <tr><td></td></tr>
                                <tr><td class="h1"><b>Profile</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>Web oriented super motivated developer just out of school trying to make it in the big world. I am currently looking for a web developer job where I can show my skills and hone them gradually.</td></tr>
                                    <tr><td></td></tr>
                                <tr><td class="h1"><b>Education</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td><i>2016 - 2018</i></td></tr>
                                    <tr><td><b>MBO 4 IT Application developer</b></td></tr>
                                    <tr><td>Application development training</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td><i>feb 2015 - okt 2015</i></td></tr>
                                    <tr><td><b>MBO 2 IT collaborator</b></td></tr>
                                    <tr><td>IT support training</td></tr>
                                    <tr><td></td></tr>
                                <tr><td class="h1"><b>Experience</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td><i>Januari 2018 - june 2018</i></td></tr>
                                    <tr><td><b>Sensimedia</b></td></tr>
                                    <tr><td>Trainee</td></tr>
                                    <tr>
                                        <td>Student honing his skills. Learned alot of different programming languages and honed my skills I did mostly HTML(Twig), CSS, PHP, a little bit of jQuery and worked with symfony.</td>
                                        <td></td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <tr><td><i>December 2016 - februari 2017</i></td></tr>
                                    <tr><td><b>Premiums.mobi</b></td></tr>
                                    <tr><td>Trainee</td></tr>
                                    <tr>
                                        <td>Student learning the basics. started programming html, css and jQuery and learning to be able to make responsive designs and working togheter with a designer to make beautiful websites.</td>
                                        <td></td>
                                    </tr>
                                    <tr><td></td></tr>
                                <tr><td class="h1"><b>Skills</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td><img class="img" src="../httpdocs/img/bvalid.png"  width="10" height="10">Good communication - written and oral skills</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td><img class="img" src="../httpdocs/img/bvalid.png"  width="10" height="10">Very motivated - with a iron will to learn</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="h1"><b>Technical knowledge</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td>-Linux/Ubuntu/Debian</td></tr>
                                    <tr><td>-Windows systems</td></tr>
                                    <tr><td>-Symfony</td></tr>
                                    <tr><td>-API (TCPDF/Tinyproxy/css-to-inline-styles)</td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="h1"><b>Hobbies</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <table>
                                            <tr>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/techno.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Technology</td></tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/gaming.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Gaming</td></tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/dog.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Pets</td></tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/airsoft.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Airsoft</td></tr>
                                                    </table>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr><td></td></tr>
                                            <tr>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/learning.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Learning</td></tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/motor.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Motorcycling</td></tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/swimming.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Swimming</td></tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr><td align="center"><img class="img" src="../httpdocs/img/worker.png"  width="40" height="40"></td></tr>
                                                        <tr><td align="center">Industrious person</td></tr>
                                                    </table>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </tr>
                                        <tr><td></td></tr>
                                        <tr><td></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr><td></td></tr>
                    <tr>
                        <td>I hereby authorize you to process my personal information to help you with my job application. my personal information may never be changed, sold or made public by any means necessary.</td>
                    </tr>
                </table>
            </body>
        </html>
    ';
    $pdf->writeHTML($html, true, 0, true, 0);
    $pdf->lastPage();
    ob_end_clean();
    $filename = $pdfname;
    $pdf->Output(dirname(__DIR__, 2) . '/generatedpdf/' . $filename, 'F');
}

