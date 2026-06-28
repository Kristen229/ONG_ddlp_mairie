<style>
    .page-number:after { content: counter(page); }
</style>
<div style="position: fixed; bottom: -20px; left: 0; width: 100%; font-size: 9px; color: #9ca3af; font-style: italic; border-top: 1px solid #e5e7eb; padding-top: 5px;">
    <table style="width: 100%; border: none; margin: 0; padding: 0;">
        <tr>
            <td style="text-align: left; border: none; width: 33%;">Généré le {{ now()->format('d/m/Y à H:i') }}</td>
            <td style="text-align: center; border: none; width: 34%;">Fait par la Direction des Systèmes d'Information (DSI)</td>
            <td style="text-align: right; border: none; width: 33%;"><span class="page-number"></span></td>
        </tr>
    </table>
</div>
