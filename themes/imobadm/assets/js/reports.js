
// document.getElementById("printReports").addEventListener("click", function () {
//     var tabela = document.querySelector("table");
//     var janelaImpressao = window.open('', '', 'width=800, height=600');
//     janelaImpressao.document.open();
//     janelaImpressao.document.write('<html><head><title>Relatórios</title><link rel="stylesheet" type="text/css" href="https://localhost/imob/themes/imobadm/assets/css/print.css"></link></head><body>');
//     janelaImpressao.document.write('<h1>Relatório</h1>');
//     janelaImpressao.document.write(tabela.outerHTML);
//     janelaImpressao.document.write('</body></html>');
//     janelaImpressao.document.close();
//     janelaImpressao.print();
//     janelaImpressao.close();

// });

document.getElementById("printReports").addEventListener("click", function () {
    window.print();
});

