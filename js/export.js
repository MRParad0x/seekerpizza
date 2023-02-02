/* Start Export Page Excel Sheet Button Function */

function html_table_to_excel(type) {
  var data = document.getElementById("productlist");

  var file = XLSX.utils.table_to_book(data, { sheet: "sheet1" });

  XLSX.write(file, { bookType: type, bookSST: true, type: "base64" });

  XLSX.writeFile(file, "file." + type);
}

const export_button = document.getElementById("exportbtn");

export_button.addEventListener("click", () => {
  html_table_to_excel("xlsx");
});

/* End Export Page Excel Sheet Button Function */
