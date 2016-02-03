<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>
        @yield('subject')
    </title>
    <style type="text/css">
        /* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
        body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

        /* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
        body{margin:0; padding:0;}
        img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
        table{border-collapse:collapse !important;}
        body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}

        /* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

        /* ========== Page Styles ========== */

        #bodyCell{padding:20px;}
        #templateContainer{width:600px;}

        body, #bodyTable{
            /*@editable*/ background-color:#DEE0E2;
        }

        #bodyCell{
            /*@editable*/ border-top:4px solid #BBBBBB;
        }

        #templateContainer{
            /*@editable*/ border:1px solid #BBBBBB;
        }

        h1{
            /*@editable*/ color:#202020 !important;
            display:block;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:26px;
            /*@editable*/ font-style:normal;
            /*@editable*/ font-weight:bold;
            /*@editable*/ line-height:100%;
            /*@editable*/ letter-spacing:normal;
            margin-top:0;
            margin-right:0;
            margin-bottom:10px;
            margin-left:0;
            /*@editable*/ text-align:left;
        }

        h2{
            /*@editable*/ color:#404040 !important;
            display:block;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:20px;
            /*@editable*/ font-style:normal;
            /*@editable*/ font-weight:bold;
            /*@editable*/ line-height:100%;
            /*@editable*/ letter-spacing:normal;
            margin-top:0;
            margin-right:0;
            margin-bottom:10px;
            margin-left:0;
            /*@editable*/ text-align:left;
        }

        h3{
            /*@editable*/ color:#606060 !important;
            display:block;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:16px;
            /*@editable*/ font-style:italic;
            /*@editable*/ font-weight:normal;
            /*@editable*/ line-height:100%;
            /*@editable*/ letter-spacing:normal;
            margin-top:0;
            margin-right:0;
            margin-bottom:10px;
            margin-left:0;
            /*@editable*/ text-align:left;
        }

        h4{
            /*@editable*/ color:#808080 !important;
            display:block;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:14px;
            /*@editable*/ font-style:italic;
            /*@editable*/ font-weight:normal;
            /*@editable*/ line-height:100%;
            /*@editable*/ letter-spacing:normal;
            margin-top:0;
            margin-right:0;
            margin-bottom:10px;
            margin-left:0;
            /*@editable*/ text-align:left;
        }

        /* ========== Header Styles ========== */

        #templatePreheader{
            /*@editable*/ background-color:#F4F4F4;
            /*@editable*/ border-bottom:1px solid #CCCCCC;
        }

        .preheaderContent{
            /*@editable*/ color:#808080;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:10px;
            /*@editable*/ line-height:125%;
            /*@editable*/ text-align:left;
        }

        .preheaderContent a:link, .preheaderContent a:visited, /* Yahoo! Mail Override */ .preheaderContent a .yshortcuts /* Yahoo! Mail Override */{
            /*@editable*/ color:#606060;
            /*@editable*/ font-weight:normal;
            /*@editable*/ text-decoration:underline;
        }

        #templateHeader{
            /*@editable*/ background-color:#F4F4F4;
            /*@editable*/ border-top:1px solid #FFFFFF;
            /*@editable*/ border-bottom:1px solid #CCCCCC;
        }

        .headerContent{
            /*@editable*/ color:#505050;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:20px;
            /*@editable*/ font-weight:bold;
            /*@editable*/ line-height:100%;
            /*@editable*/ padding-top:0;
            /*@editable*/ padding-right:0;
            /*@editable*/ padding-bottom:0;
            /*@editable*/ padding-left:0;
            /*@editable*/ text-align:left;
            /*@editable*/ vertical-align:middle;
        }

        .headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
            /*@editable*/ color:#42CFD2;
            /*@editable*/ font-weight:normal;
            /*@editable*/ text-decoration:underline;
        }

        #headerImage{
            height:auto;
            max-width:600px;
        }

        /* ========== Body Styles ========== */

        #templateBody{
            /*@editable*/ background-color:#F4F4F4;
            /*@editable*/ border-top:1px solid #FFFFFF;
            /*@editable*/ border-bottom:1px solid #CCCCCC;
        }

        .bodyContent{
            /*@editable*/ color:#505050;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:14px;
            /*@editable*/ line-height:150%;
            padding-top:20px;
            padding-right:20px;
            padding-bottom:20px;
            padding-left:20px;
            /*@editable*/ text-align:left;
        }

        .bodyContent a:link, .bodyContent a:visited, /* Yahoo! Mail Override */ .bodyContent a .yshortcuts /* Yahoo! Mail Override */{
            /*@editable*/ color:#42CFD2;
            /*@editable*/ font-weight:normal;
            /*@editable*/ text-decoration:underline;
        }

        .bodyContent img{
            display:inline;
            height:auto;
            max-width:560px;
        }

        /* ========== Footer Styles ========== */

        #templateFooter{
            /*@editable*/ background-color:#F4F4F4;
            /*@editable*/ border-top:1px solid #FFFFFF;
        }

        .footerContent{
            /*@editable*/ color:#808080;
            /*@editable*/ font-family:Helvetica;
            /*@editable*/ font-size:10px;
            /*@editable*/ line-height:150%;
            padding-top:20px;
            padding-right:20px;
            padding-bottom:20px;
            padding-left:20px;
            /*@editable*/ text-align:left;
        }

        .footerContent a:link, .footerContent a:visited, /* Yahoo! Mail Override */ .footerContent a .yshortcuts, .footerContent a span /* Yahoo! Mail Override */{
            /*@editable*/ color:#606060;
            /*@editable*/ font-weight:normal;
            /*@editable*/ text-decoration:underline;
        }

        /* /\/\/\/\/\/\/\/\/ MOBILE STYLES /\/\/\/\/\/\/\/\/ */

        @media only screen and (max-width: 480px){
            /* /\/\/\/\/\/\/ CLIENT-SPECIFIC MOBILE STYLES /\/\/\/\/\/\/ */
            body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */
            body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */

            /* /\/\/\/\/\/\/ MOBILE RESET STYLES /\/\/\/\/\/\/ */
            #bodyCell{padding:10px !important;}

            /* /\/\/\/\/\/\/ MOBILE TEMPLATE STYLES /\/\/\/\/\/\/ */

            /* ======== Page Styles ======== */

            #templateContainer{
                max-width:600px !important;
                /*@editable*/ width:100% !important;
            }

            h1{
                /*@editable*/ font-size:24px !important;
                /*@editable*/ line-height:100% !important;
            }

            h2{
                /*@editable*/ font-size:20px !important;
                /*@editable*/ line-height:100% !important;
            }

            h3{
                /*@editable*/ font-size:18px !important;
                /*@editable*/ line-height:100% !important;
            }

            h4{
                /*@editable*/ font-size:16px !important;
                /*@editable*/ line-height:100% !important;
            }

            /* ======== Header Styles ======== */

            #templatePreheader{display:none !important;} /* Hide the template preheader to save space */

            #headerImage{
                height:auto !important;
                /*@editable*/ max-width:600px !important;
                /*@editable*/ width:100% !important;
            }

            .headerContent{
                /*@editable*/ font-size:20px !important;
                /*@editable*/ line-height:125% !important;
            }

            /* ======== Body Styles ======== */

            .bodyContent{
                /*@editable*/ font-size:18px !important;
                /*@editable*/ line-height:125% !important;
            }

            /* ======== Footer Styles ======== */

            .footerContent{
                /*@editable*/ font-size:14px !important;
                /*@editable*/ line-height:115% !important;
            }

            .footerContent a{display:block !important;} /* Place footer social and utility links on their own lines, for easier access */
        }
    </style>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
<center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
        <tr>
            <td align="center" valign="top" id="bodyCell">
                <!-- BEGIN TEMPLATE // -->
                <table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                    <tr>
                        <td align="center" valign="top">
                            <!-- BEGIN PREHEADER // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templatePreheader">
                                <tr>
                                    <td valign="top" class="preheaderContent" style="padding-top:10px; padding-right:20px; padding-bottom:10px; padding-left:20px;" mc:edit="preheader_content00">
                                        @yield('teaser')
                                    </td>
                                </tr>
                            </table>
                            <!-- // END PREHEADER -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- BEGIN BODY // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                <tr>
                                    <td valign="top" class="bodyContent" mc:edit="body_content">
                                        @yield('content')
                                    </td>
                                </tr>
                            </table>
                            <!-- // END BODY -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- BEGIN FOOTER // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                <tr>
                                    <td valign="top" class="footerContent" style="padding-top:15px;" mc:edit="footer_content01">
                                        <em>Copyright &copy; {{ date("Y") }} {{ W4P\Models\Setting::get('organisation.name') }}, All rights reserved.</em>
                                    </td>
                                </tr>
                            </table>
                            <!-- // END FOOTER -->
                        </td>
                    </tr>
                </table>
                <!-- // END TEMPLATE -->
            </td>
        </tr>
    </table>
</center>
</body>
</html>
