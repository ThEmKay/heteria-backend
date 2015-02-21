<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            Stammdaten
        </title>
    </head>
    <body>
        <a href="<?php echo site_url('kunden'); ?>">&laquo; Kunden</a>
        <h1>Stammdaten</h1>
        <?php echo validation_errors(); ?>
        <form name="frmStammdaten" action="<?php echo current_url(); ?>" method="post">
            <table cellpadding="5" cellspacing="2" width="50%">
                <tr>
                    <td>
                        Kundennummer
                    </td>
                    <td>
                        {nummer}
                    </td>
                </tr>
                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        <input type="text" name="fldName" value="<?php echo set_value('fldName', '{name}'); ?>" style="width:100%" />
                    </td>        
                </tr>
                <tr>
                    <td>
                        PLZ
                    </td>
                    <td>
                        <input type="text" name="fldPlz" value="<?php echo set_value('fldPlz', '{plz}'); ?>" size="5" maxlength="5" />
                    </td>        
                </tr>
                <tr>
                    <td>
                        Ort
                    </td>
                    <td>
                        <input type="text" name="fldOrt" value="<?php echo set_value('fldOrt', '{ort}'); ?>" style="width:100%" />
                    </td>        
                </tr>
                <tr>
                    <td>
                        Stra&szlig;e
                    </td>
                    <td>
                        <input type="text" name="fldStrasse" value="<?php echo set_value('fldStrasse', '{strasse}'); ?>" style="width:100%" />
                    </td>        
                </tr>
                <tr>
                    <td>
                        Bundesland
                    </td>
                    <td>
                        <input type="text" name="fldBundesland" value="<?php echo set_value('fldBundesland', '{bundesland}'); ?>" style="width:100%" />
                    </td>        
                </tr>     
            </table>
            <input type="submit" name="btnSpeichern" value="Speichern" />
        </form>
        
    </body>
</html>