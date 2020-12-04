<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width" name="viewport"/>
    <!--[if !mso]><!-->
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <!--<![endif]-->
    <title></title>
    <!--[if !mso]><!-->
    <!--<![endif]-->
    <?= view("{$carpeta}/mensajes/emails/partes/style.php") ?>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: transparent;">
    <?= view("{$carpeta}/mensajes/emails/partes/style2.php") ?>
<!--[if IE]><div class="ie-browser"><![endif]-->
<table bgcolor="transparent" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: transparent; width: 100%;" valign="top" width="100%">
    <tbody>
        <tr style="vertical-align: top;" valign="top">
            <td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:transparent"><![endif]-->
                <?= view("{$carpeta}/mensajes/emails/partes/logo", ["carpeta" => $carpeta]) ?>

                <div style="background-color:transparent;">
                    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:transparent;width:500px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;;">
                                <div style="width:100% !important;">
                                    <!--[if (!mso)&(!IE)]><!-->
                                    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                        <!--<![endif]-->
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 15px; padding-top: 15px; padding-bottom: 15px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0;">
                                                    <strong>
                                                        <span style="font-size: 18px; line-height: 21px;">
                                                            HOLA <?= mb_strtoupper($configuracion->_get("razonsical")) ?>,
                                                        </span>
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0; text-transform: uppercase;">
                                                    <span style="font-size: 14px; line-height: 16px;">
                                                        Has recibido un mensaje de la web
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->
                                        <!--[if (!mso)&(!IE)]><!-->
                                    </div>
                                    <!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <div style="background-color:transparent;">
                    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #F4F4F4;;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F4F4F4;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:#F4F4F4"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:#F4F4F4;width:500px; border-top: 1px solid #D9D9D9; border-left: 1px solid #D9D9D9; border-bottom: 1px solid #D9D9D9; border-right: 1px solid #D9D9D9;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:15px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;;">
                                <div style="width:100% !important;">
                                    <!--[if (!mso)&(!IE)]><!-->
                                    <div style="border-top:1px solid #D9D9D9; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding-top:10px; padding-bottom:15px; padding-right: 10px; padding-left: 10px;">
                                        <!--<![endif]-->
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <span style="font-size: 14px; line-height: 16px; text-transform: uppercase;">
                                                        <strong>
                                                            DETALLES DEL MENSAJE
                                                        </strong>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->
                                        <table border="0" cellpadding="0" cellspacing="0" class="divider" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 1px solid #BBBBBB;" valign="top" width="100%">
                                                            <tbody>
                                                                <tr style="vertical-align: top;" valign="top">
                                                                    <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <?php if (isset($ficha["nombre"])): ?>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0; margin-bottom: 15px;">
                                                        <b>Nombre: </b><?= $ficha["nombre"] ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if (isset($ficha["email"])): ?>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                        <b>Email: </b><?= $ficha["email"] ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if (isset($ficha["telefono"])): ?>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                        <b>Telefono: </b><?= $ficha["telefono"] ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if (isset($ficha["piso"])): ?>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                        <b>Piso: </b><?= $ficha["piso"] ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if (isset($ficha["referencia"])): ?>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                        <b>Referencia: </b><?= $ficha["referencia"] ?>
                                                    </p>
                                                <?php endif; ?>
                                                <hr>
                                                <?php if (isset($ficha["asunto"])): ?>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                        <b>Referencia: </b><?= $ficha["asunto"] ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if (isset($ficha["mensaje"])): ?>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0; border: 1px silver solid; padding: 15px; border-radius: 5px;">
                                                        <b>Mensaje: </b><?= $ficha["mensaje"] ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->
                                        <!--[if (!mso)&(!IE)]><!-->
                                    </div>
                                    <!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
        </tr>
    </tbody>
</table>
<!--[if (IE)]></div><![endif]-->
</body>
</html>
