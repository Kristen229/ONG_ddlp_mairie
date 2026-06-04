<div style="width: 100%; border-bottom: 2px solid #1e3a8a; padding-bottom: 15px; margin-bottom: 25px; font-family: DejaVu Sans, sans-serif;">
    <table style="width: 100%; border: none; margin: 0; padding: 0;">
        <tr>
            <!-- Left block: Logos and Republic Text -->
            <td style="width: 65%; text-align: left; vertical-align: middle; border: none; padding: 0;">
                <table style="border: none; margin: 0; padding: 0;">
                    <tr>
                        <td style="vertical-align: middle; border: none; padding: 0; padding-right: 15px;">
                            <?php 
                                $beninLogo = public_path('build/assets/Coat_of_arms_of_Benin.png');
                                if(file_exists($beninLogo)) {
                                    $beninData = base64_encode(file_get_contents($beninLogo));
                                    echo '<img src="data:image/png;base64,' . $beninData . '" style="height: 80px;">';
                                }
                            ?>
                        </td>
                        <td style="vertical-align: middle; text-align: center; border: none; padding: 0; padding-right: 15px;">
                            <div style="font-weight: bold; font-size: 14px; color: #000000; margin-bottom: 4px;">RÉPUBLIQUE DU BÉNIN</div>
                            <div style="width: 100%; height: 4px; display: table; margin: 0 auto 4px auto;">
                                <div style="display: table-cell; width: 33.3%; background-color: #008751;"></div>
                                <div style="display: table-cell; width: 33.3%; background-color: #FCD116;"></div>
                                <div style="display: table-cell; width: 33.3%; background-color: #E8112D;"></div>
                            </div>
                            <div style="font-weight: bold; font-size: 16px; color: #000000;">MAIRIE DE COTONOU</div>
                        </td>
                        <td style="vertical-align: middle; border: none; padding: 0;">
                            <?php 
                                $cotonouLogo = public_path('build/assets/Logo_MCOT-2023-08_Final_qokf8t.png');
                                if(file_exists($cotonouLogo)) {
                                    $cotonouData = base64_encode(file_get_contents($cotonouLogo));
                                    echo '<img src="data:image/png;base64,' . $cotonouData . '" style="height: 80px;">';
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </td>

            <!-- Right block: Contact Info -->
            <td style="width: 35%; text-align: right; vertical-align: middle; border: none; padding: 0; font-size: 11px; color: #000000; line-height: 1.4;">
                <div style="font-weight: bold; font-size: 12px; margin-bottom: 2px;">SECRÉTARIAT EXÉCUTIF</div>
                03 B.P. 1777<br>
                Cotonou - Bénin<br>
                Tél : +229 21 30 95 69<br>
                mairiecotonou.infos@gouv.bj<br>
                www.cotonou.mairie.bj
            </td>
        </tr>
    </table>
</div>
