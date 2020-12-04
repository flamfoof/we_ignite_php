<?php
use App\Entities\Pedido;
?>
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
    <?= view("{$carpeta}/mensajes/emails/partes/script") ?>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
<!--[if IE]><div class="ie-browser"><![endif]-->
<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" valign="top" width="100%">
    <tbody>
        <tr style="vertical-align: top;" valign="top">
            <td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#FFFFFF"><![endif]-->

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
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0;">
                                                    <strong>
                                                        <span style="font-size: 18px; line-height: 21px;">
                                                            HOLA <?= $pedido->_get("nombre") ?>,
                                                        </span>
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0;">
                                                    GRACIAS POR SU COMPRAR EN
                                                    <?= $config->_get("nombretienda") ?>

                                                    <?php if ($pedido->_get("estadopago") == 0): ?>
                                                        <br><br>
                                                        Gracias por su pedido, una vez realizado el pago,
                                                        recibirá otro mail de confirmación. Si ya ha realizado el pago,
                                                        puede que el correo tarde unos minutos en llegar, si no le
                                                        llega en 15 minutos, póngase en contacto con nosotros en el para ayudarle.
                                                    <?php endif; ?>
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
                            <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:#F4F4F4;width:500px; border-top: 1px solid #D9D9D9; border-left: 1px solid #D9D9D9; border-bottom: 1px solid #D9D9D9; border-right: 1px solid #D9D9D9;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;;">
                                <div style="width:100% !important;">
                                    <!--[if (!mso)&(!IE)]><!-->
                                    <div style="border-top:1px solid #D9D9D9; border-left:1px solid #D9D9D9; border-bottom:1px solid #D9D9D9; border-right:1px solid #D9D9D9; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                        <!--<![endif]-->


                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <p style="font-size: 12px; line-height: 16px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0;">
                                                <span style="font-size: 14px;">
                                                    <strong>Detalles de tu compra</strong>
                                                </span>
                                            </p>
                                        </div>


                                        <!--[if mso]></td></tr></table><![endif]-->
                                        <table border="0" cellpadding="0" cellspacing="0" class="divider" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
                                            <tbody>
                                                <tr style="vertical-align: top;" valign="top">
                                                    <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 1px solid #BBBBBB; height: 0px;" valign="top" width="100%">
                                                            <tbody>
                                                                <tr style="vertical-align: top;" valign="top">
                                                                    <td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
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

                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <strong>Pedido:</strong> <?= $pedido->_id() ?>
                                                </p>
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <strong>Fecha:</strong> <?= date("d-m-Y H:i:s") ?>
                                                </p>
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;"><strong>Teléfono:</strong>
                                                    <?= $pedido->_get("telefono") ?>
                                                </p>
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <strong>Forma de pago:</strong>
                                                    <?= $pedido->getFormaPago()->getMetodo()->_get("nombre") ?>
                                                </p>
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <strong>Estado del pedido:</strong>
                                                    <?= Pedido::$estados[intval($pedido->_get("estado"))] ?>
                                                </p>
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <strong>Estado del pago:</strong>
                                                    <?= Pedido::$estadospagos[intval($pedido->_get("estadopago"))] ?>
                                                    <?php if (
                                                        ($pedido->_get("estadopago") == 0) &&
                                                        (
                                                            ($pedido->_get("formapago") == 0) ||
                                                            ($pedido->_get("formapago") == 3)
                                                        )
                                                        ): ?>
                                                        <?php if ($pedido->getUsuario()->_id() > 0): ?>
                                                            | <a href="<?= site_url("carrito/pagar/repetir") ?>">Pagar pedido</a>
                                                        <?php else: ?>
                                                            | <a href="<?= site_url("carrito/pagar/repetir/invitado/{$pedido->_id()}") ?>">Pagar pedido</a>
                                                        <?php endif; ?>
                                                    <?php else: ?>

                                                    <?php endif; ?>
                                                </p>
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <strong>Envío: </strong>
                                                    <?php if ($pedido->_get("tipoenvio") == 2): ?>
                                                        Recoger en local
                                                        <div class="" style="margin-top: 10px; padding: 10px; border: 1px silver solid;">
                                                            <?= $config->_get("direccion") ?>
                                                        </div>
                                                    <?php else: ?>
                                                        Enviar a mi dirección
                                                        <div class="" style="margin-top: 10px; padding: 10px; border: 1px silver solid;">
                                                            <?= $pedido->getDireccionEnvioTxt() ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </p>
                                                <?php if (intval($pedido->getFormaPago()->getMetodo()->_get("modulo")) == 5): ?>
                                                    <hr>
                                                    <p style="font-size: 14px; line-height: 16px; margin: 0;"><strong>Recuerda:</strong>
                                                         Hacer el ingreso en la cuenta
                                                         <?= $config->_get("iban") ?>
                                                         con el concepto del nº de pedido.
                                                     </p>
                                                <?php endif; ?>
                                                <hr>
                                                <p style="font-size: 14px; line-height: 16px; margin: 0;">
                                                    <strong>Observaciones:</strong>
                                                    <?= $pedido->_get("observaciones") ?>
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
                    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:transparent;width:500px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;;">
                                <div style="width:100% !important;">
                                    <!--[if (!mso)&(!IE)]><!-->
                                    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                        <!--<![endif]-->
                                        <div></div>
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
                    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:transparent;width:500px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;;">
                                <div style="width:100% !important;">
                                    <!--[if (!mso)&(!IE)]><!-->
                                    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                        <!--<![endif]-->
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                <table style="width: 100%;" border="1">
                                                    <thead>
                                                        <tr>
                                                            <th style="background: #EEE; padding: 15px; font-size: 14px;">Referencia</th>
                                                            <th style="background: #EEE; padding: 15px; font-size: 14px;">Producto</th>
                                                            <th style="background: #EEE; padding: 15px; font-size: 14px;">Precio</th>
                                                            <th style="background: #EEE; padding: 15px; font-size: 14px;">Importe</th>
                                                            <th style="background: #EEE; padding: 15px; font-size: 14px;">Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $productos = $pedido->getProductos() ?>
                                                        <?php foreach ($productos as $key => $producto): ?>
                                                            <tr>
                                                                <td style="text-align: center; padding: 5px;"><?= $producto->getCombinacion()->_get("sku") ?></td>
                                                                <td style="text-align: center; padding: 5px;"><?= $producto->getNombreCliente() ?></td>
                                                                <td style="text-align: center; padding: 5px;"><?= moneda($producto->_get("precio")) ?></td>
                                                                <td style="text-align: center; padding: 5px;"><?= $producto->_get("cantidad") ?></td>
                                                                <td style="text-align: center; padding: 5px;"><?= moneda($producto->_get("precio") * $producto->_get("cantidad")) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
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
                    <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                            <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:transparent;width:500px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;;">
                                <div style="width:100% !important;">
                                    <!--[if (!mso)&(!IE)]><!-->
                                    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                        <!--<![endif]-->
                                        <div></div>
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
                            <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:#F4F4F4;width:500px; border-top: 1px solid #D9D9D9; border-left: 1px solid #D9D9D9; border-bottom: 1px solid #D9D9D9; border-right: 1px solid #D9D9D9;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                            <div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top;     border: 1px #CCC solid; padding: 15px;">
                                <div style="width:100% !important;">
                                    <!--[if (!mso)&(!IE)]><!-->
                                    <div style="padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                        <!--<![endif]-->
                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                                        <div style="color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                            <div style="font-size: 12px; line-height: 14px; color: #555555; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; float: right;">
                                                <table class="table">
                                                    <tr>
                                                        <td class="text-uppercase text-14">Subtotal</td>
                                                        <td class="text-14"><?= moneda($pedido->_get("subtotal")) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase text-14">Descuento</td>
                                                        <td class="text-14"><?= moneda($pedido->_get("descuento")) ?></td>
                                                    </tr>
                                                    <?php if ($pedido->_get("giftcard") > 0): ?>
                                                        <tr>
                                                            <td class="text-uppercase text-14">GiftCard</td>
                                                            <td class="text-14"><?= moneda($pedido->_get("giftcard")) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <tr>
                                                        <td class="text-uppercase text-14">Gastos de envío</td>
                                                        <td class="text-14"><?= moneda($pedido->_get("gastosenvio")) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase text-14">Gatos metodo de pago</td>
                                                        <td class="text-14"><?= moneda($pedido->_get("comision")) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-uppercase text-14">IVA</td>
                                                        <td class="text-14"><?= moneda($pedido->_get("iva")) ?></td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #777; margin-top: 5px;">
                                                        <td class="text-uppercase text-14" style="font-weight: bold; font-size: 14px;">Total</td>
                                                        <td class="text-14 bold" style="font-size: 14px;">
                                                            <?= moneda($pedido->_get("total")) ?>
                                                        </td>
                                                    </tr>
                                                </table>
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
