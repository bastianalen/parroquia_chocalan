function tablePrint() {
    var display_setting = "toolbar=no,location=no,directories=no,menubar=no,";
    display_setting += "scrollbars=no,width=500, height=500, left=100, top=25";
    var content_innerhtml = document.getElementById("printout").innerHTML;
    var document_print = window.open("", "", display_setting);
    document_print.document.open();
    document_print.document.write('<body style="font-family:Calibri(body);  font-size:11px;" onLoad="self.print();self.close();" >');
    document_print.document.write(content_innerhtml);
    document_print.document.write('</body></html>');
    document_print.print();
    document_print.document.close();
    return false;
}
$(document).ready(function () {
    oTable = jQuery('#list').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
});