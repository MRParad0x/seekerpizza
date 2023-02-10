/* Start Product Page Print Button Function */

jQuery(function ($) {
  $("#proprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".product-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Name: { type: String },
          Category: { type: String },
          Price: { type: Number },
          Description: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "portrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "Product ID", width: 70 },
          { field: "Name", title: "Product Name", width: 120 },
          { field: "Category", title: "Category", width: 60 },
          { field: "Price", title: "Price(Rs)", width: 60 },
          { field: "Description", title: "Description", width: 200 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "ProductListPDF",
      });
    });
  });
});

/* End Product Page Print Button Function */

/* Start Category Page Print Button Function */

jQuery(function ($) {
  $("#catprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".category-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Name: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "portrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "Category ID", width: 80 },
          { field: "Name", title: "Category Name", width: 120 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "CategoryListPDF",
      });
    });
  });
});

/* End Category Page Print Button Function */

/* Start Coupon Page Print Button Function */

jQuery(function ($) {
  $("#couprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".coupon-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Code: { type: String },
          Discount: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "portrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "Coupon ID", width: 80 },
          { field: "Code", title: "Coupon Code", width: 100 },
          { field: "Discount", title: "Coupon Discount", width: 100 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "CoupontListPDF",
      });
    });
  });
});

/* End Coupon Page Print Button Function */

/* Start Subscriber Page Print Button Function */

jQuery(function ($) {
  $("#subprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".subscriber-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Name: { type: String },
          Email: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "portrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "Subscriber ID", width: 80 },
          { field: "Name", title: "Subscriber Name", width: 100 },
          { field: "Email", title: "Subscriber Email", width: 100 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "SubscribertListPDF",
      });
    });
  });
});

/* End Subscriber Page Print Button Function */

/* Start Role Page Print Button Function */

jQuery(function ($) {
  $("#rolprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".role-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Type: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "portrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "Role ID", width: 80 },
          { field: "Type", title: "Role Name", width: 100 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "RoletListPDF",
      });
    });
  });
});

/* End Role Page Print Button Function */

/* Start User Page Print Button Function */

jQuery(function ($) {
  $("#useprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".user-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          NIC: { type: String },
          Username: { type: String },
          FullName: { type: String },
          Email: { type: String },
          Number: { type: String },
          Address: { type: String },
          Role: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "landscape");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "NIC", title: "NIC", width: 80 },
          { field: "Username", title: "Username", width: 80 },
          { field: "FullName", title: "Full Name", width: 110 },
          { field: "Email", title: "Email", width: 150 },
          { field: "Number", title: "Phone Number", width: 90 },
          { field: "Address", title: "Address", width: 200 },
          { field: "Role", title: "Role Type", width: 60 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "RoletListPDF",
      });
    });
  });
});

/* End User Page Print Button Function */

/* Start Order Page Print Button Function */

jQuery(function ($) {
  $("#ordprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".order-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Date: { type: String },
          Customer: { type: String },
          Total: { type: Number },
          Status: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "potrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "Order ID", width: 70 },
          { field: "Date", title: "Order Date", width: 70 },
          { field: "Customer", title: "Customer", width: 150 },
          { field: "Total", title: "Order Total", width: 80 },
          { field: "Status", title: "Order Status", width: 80 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "RoletListPDF",
      });
    });
  });
});

/* End Order Page Print Button Function */

/* Start Order items List Print Button Function */

jQuery(function ($) {
  $("#ordlprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable

    // var dataSource = shield.DataSource.create({
    //   data: ".view-order-list-table",
    //   schema: {
    //     header: true,
    //     footer: true,
    //     type: "table",
    //     fields: {
    //       Order_Id: { type: String },
    //       Order_Date: { type: String },
    //       Total: { type: Number },
    //       Name: { type: String },
    //       Address: { type: String },
    //     },
    //   },
    // });

    var dataSource = shield.DataSource.create({
      data: ".view-order-list",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          Item: { type: String },
          Name: { type: String },
          Price: { type: Number },
          Qty: { type: Number },
          Subtotal: { type: Number },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "potrait");

      // pdf.table(
      //   50,
      //   50,
      //   data,
      //   [
      //     { field: "Order_Id", title: "Order_Id", width: 70 },
      //     { field: "Order_Date", title: "Order_Date", width: 120 },
      //     { field: "Total", title: "Total (Rs)", width: 70 },
      //     { field: "Name", title: "Name", width: 50 },
      //     { field: "Address", title: "Address", width: 60 },
      //   ],
      //   {
      //     margins: {
      //       top: 50,
      //       left: 50,
      //     },
      //   }
      // );

      pdf.table(
        50,
        50,
        data,
        [
          { field: "Item", title: "Item", width: 70 },
          { field: "Name", title: "Name", width: 120 },
          { field: "Price", title: "Price (Rs)", width: 70 },
          { field: "Qty", title: "Qty", width: 50 },
          { field: "Subtotal", title: "Subtotal", width: 60 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "InvoicePDF",
      });
    });
  });
});

/* End Order items List Print Button Function */

/* Start Feedback Page Print Button Function */

jQuery(function ($) {
  $("#feeprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".order-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Date: { type: String },
          Name: { type: String },
          Email: { type: String },
          Message: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "potrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "Order ID", width: 70 },
          { field: "Date", title: "Date", width: 70 },
          { field: "Name", title: "Full Name", width: 150 },
          { field: "Email", title: "Email", width: 80 },
          { field: "Message", title: "Message", width: 80 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "FeedbackListPDF",
      });
    });
  });
});

/* End Feedback Page Print Button Function */

/* Start Report Page Print Button Function */

jQuery(function ($) {
  $("#repprintbtn").click(function () {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
      data: ".order-list-table",
      schema: {
        header: true,
        footer: true,
        type: "table",
        fields: {
          ID: { type: String },
          Product: { type: String },
          QTY: { type: Number },
          Total_Price: { type: String },
        },
      },
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
      var pdf = new shield.exp.PDFDocument({
        author: "SeekersPizza",
        created: new Date(),
      });

      pdf.addPage("a4", "potrait");

      pdf.table(
        50,
        50,
        data,
        [
          { field: "ID", title: "ID", width: 70 },
          { field: "Product", title: "Product", width: 70 },
          { field: "QTY", title: "QTY", width: 80 },
          { field: "Total_Price", title: "Total Price", width: 80 },
        ],
        {
          margins: {
            top: 50,
            left: 50,
          },
        }
      );

      pdf.saveAs({
        fileName: "ReportListPDF",
      });
    });
  });
});

/* End Report Page Print Button Function */
