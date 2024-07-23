// فاتورة شراء

function deleteRow_equipment(button) {
    var row = button.closest("tr");
    row.remove();
}
function add_equipmentRow_with_info_pressEnter(
    divName,
    material_id,
    material_name,
    unit_name,
    price,
    earning_per,
    currency,
    end_date,
    quantity
) {
    var row = $("#materialTable tbody tr").length;
    var count = row + 1;
    console.log(count);
    var newdiv = document.createElement("tr");
    newdiv.innerHTML +=
        '<td style="padding-top: 2%" class="text-center">' + count + "</td>";
    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow_equipment(this)"><i style="font-size: 22px;color:red;" class="mdi mdi-trash-can d-block"></i></button></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' +
        material_name +
        ' <input hidden type="text"  name="material_name[]" readonly id="material_name_' +
        count +
        '"  class="form-control text-right"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.01" min="0" required  name="material_number[]" id="material_number_' +
        count +
        '" class="form-control text-right" placeholder="الكمية" /><div class="invalid-feedback"></div></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' +
        unit_name +
        ' <input hidden type="text"  name="unit_name[]" readonly id="unit_name_' +
        count +
        '"  class="form-control text-right"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.0001" min="0" required name="price[]" id="price_' +
        count +
        '" class="form-control text-right" placeholder="السعر" /><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input readonly type="number" step="0.01" required name="total[]" id="total_' +
        count +
        '" class="form-control text-right" placeholder="الاجمالي" value="' +
        0 +
        '"/><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        currency +
        '<input type="text" hidden  name="currency[]" id="currency_' +
        count +
        '" class="form-control text-right" placeholder="العملة"value="' +
        currency +
        '"/></td>';

    // newdiv.innerHTML +=
    //     '<td class="text-center"><select required name="currency[]" id="currency_' +
    //     count +
    //     '" class="form-control text-right"><option value="دولار">دولار</option><option value="سوري">سوري</option></select></td>';

    newdiv.innerHTML +=
        '<td class="text-center"><input type="date"  name="end_date[]" id="end_date_' +
        count +
        '" class="form-control text-right" placeholder="تاريخ الانتهاء"  /><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        quantity +
        '<input type="text" hidden readonly name="quantity[]" id="quantity_' +
        count +
        '" class="form-control text-right" placeholder="الكمية الحالية"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        ' <input hidden type="text"  name="material_id[]" readonly id="material_id_' +
        count +
        '"value = "' +
        material_id +
        '"  class="form-control text-right"/></td>';
    document.getElementById(divName).prepend(newdiv);

    count++;
}

function roundToDecimal(number, decimalPlaces) {
    var multiplier = Math.pow(10, decimalPlaces);
    return Math.round(number * multiplier) / multiplier;
}
function add_equipmentRow_with_info_pressEnter_sell(
    divName,
    material_id,
    material_name,
    unit_name,
    material_number,
    price,
    earning_per,
    currency,
    quantity
) {
    var earning_per = earning_per / 100; // Convert earning percentage to a decimal (e.g., 10% to 0.1)
    var price_part = price * earning_per; // Calculate the portion of the price based on the earning percentage

    // Convert earning_per and price_part to numbers
    earning_per = parseFloat(earning_per);
    price_part = parseFloat(price_part);

    // Find the sum of earning_per and price_part
    var sum = (price_part + parseFloat(price)).toFixed(2);

    console.log("Sum of earning_per and price_part:", sum);

    var row = $("#materialTable tbody tr").length;
    var count = row + 1;
    var newdiv = document.createElement("tr");
    newdiv.innerHTML +=
        '<td style="padding-top: 2%" class="text-center">' + count + "</td>";
    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow_equipment(this)"><i style="font-size: 22px;color:red;" class="mdi mdi-trash-can d-block"></i></button></td>';
    newdiv.innerHTML +=
        '<td  class="text-center">' +
        material_name +
        ' <input hidden type="text"  name="material_name[]" readonly id="material_name_' +
        count +
        '"  class="form-control text-right"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.01" required  name="material_number[]" id="material_number_' +
        count +
        '" class="form-control text-right" placeholder="الكمية" /><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML += '<td class="text-center">' + unit_name + "</td>";
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.01" required name="price[]" id="price_' +
        count +
        '" class="form-control text-right" placeholder="السعر" value="' +
        roundToDecimal(parseFloat(sum), 2) +
        '"/><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" readonly step="0.01" required name="total[]" id="total_' +
        count +
        '" class="form-control text-right" placeholder="الاجمالي" value="' +
        0 +
        '"/><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        currency +
        '<input type="text" hidden  name="currency[]" id="currency_' +
        count +
        '" class="form-control text-right" placeholder="العملة"value="' +
        currency +
        '"/></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' +
        quantity +
        '<input type="text" hidden readonly name="quantity[]" id="quantity_' +
        count +
        '" class="form-control text-right" placeholder="الكمية"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        ' <input hidden type="text"  name="material_id[]" readonly id="material_id_' +
        count +
        '"value = "' +
        material_id +
        '"  class="form-control text-right"/></td>';
    document.getElementById(divName).prepend(newdiv);

    count++;
}


function add_equipmentRow_with_info_pressEnter_buy(
    divName,
    material_id,
    material_name,
    unit_name,
    material_number,
    price,
    earning_per,
    currency,
    quantity
) {
    var earning_per = earning_per / 100; // Convert earning percentage to a decimal (e.g., 10% to 0.1)
    var price_part = price * earning_per; // Calculate the portion of the price based on the earning percentage

    // Convert earning_per and price_part to numbers
    earning_per = parseFloat(earning_per);
    price_part = parseFloat(price_part);

    // Find the sum of earning_per and price_part
    var sum = parseFloat(price).toFixed(2); // استخدام السعر الرئيسي دون إضافة الربح

    console.log("Sum of earning_per and price_part:", sum);

    var row = $("#materialTable tbody tr").length;
    var count = row + 1;
    var newdiv = document.createElement("tr");
    newdiv.innerHTML +=
        '<td style="padding-top: 2%" class="text-center">' + count + "</td>";
    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow_equipment(this)"><i style="font-size: 22px;color:red;" class="mdi mdi-trash-can d-block"></i></button></td>';
    newdiv.innerHTML +=
        '<td  class="text-center">' +
        material_name +
        ' <input hidden type="text"  name="material_name[]" readonly id="material_name_' +
        count +
        '"  class="form-control text-right"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.01" required  name="material_number[]" id="material_number_' +
        count +
        '" class="form-control text-right" placeholder="الكمية" /><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML += '<td class="text-center">' + unit_name + "</td>";
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.01" required name="price[]" id="price_' +
        count +
        '" class="form-control text-right" placeholder="السعر" value="' +
        roundToDecimal(parseFloat(sum), 2) +
        '"/><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" readonly step="0.01" required name="total[]" id="total_' +
        count +
        '" class="form-control text-right" placeholder="الاجمالي" value="' +
        0 +
        '"/><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        currency +
        '<input type="text" hidden  name="currency[]" id="currency_' +
        count +
        '" class="form-control text-right" placeholder="العملة"value="' +
        currency +
        '"/></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' +
        quantity +
        '<input type="text" hidden readonly name="quantity[]" id="quantity_' +
        count +
        '" class="form-control text-right" placeholder="الكمية"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        ' <input hidden type="text"  name="material_id[]" readonly id="material_id_' +
        count +
        '"value = "' +
        material_id +
        '"  class="form-control text-right"/></td>';
    document.getElementById(divName).prepend(newdiv);

    count++;
}
function deleteRow_equipment(button) {
    var row = button.closest("tr");
    row.remove();
}
function add_equipmentRow_with_info_pressEnter_return(
    divName,
    material_id,
    material_name,
    currency
) {
    var row = $("#materialTable tbody tr").length;
    var count = row + 1;
    console.log(count);
    var newdiv = document.createElement("tr");
    newdiv.innerHTML +=
        '<td style="padding-top: 2%" class="text-center">' + count + "</td>";
    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow_equipment(this)"><i style="font-size: 22px;color:red;" class="mdi mdi-trash-can d-block"></i></button></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' +
        material_name +
        ' <input hidden type="text"  name="material_name[]" readonly id="material_name_' +
        count +
        '"  class="form-control text-right"/></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.01" min="0" required  name="material_number[]" id="material_number_' +
        count +
        '" class="form-control text-right" placeholder="الكمية" /><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="number" step="0.0001" min="0" required name="price[]" id="price_' +
        count +
        '" class="form-control text-right" placeholder="السعر" /><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input readonly type="number" step="0.01" required name="total[]" id="total_' +
        count +
        '" class="form-control text-right" placeholder="الاجمالي" value="' +
        0 +
        '"/><div class="invalid-feedback"></div></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' +
        currency +
        '<input type="text" hidden  name="currency[]" id="currency_' +
        count +
        '" class="form-control text-right" placeholder="العملة"value="' +
        currency +
        '"/></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' +
        ' <input hidden type="text"  name="material_id[]" readonly id="material_id_' +
        count +
        '"value = "' +
        material_id +
        '"  class="form-control text-right"/></td>';
    document.getElementById(divName).prepend(newdiv);

    count++;
}

// // get current quantity for input bills
// function get_current_quantity_input(waerhouse_id, item) {
//     console.log(waerhouse_id);
//     $.ajax({
//         type: "GET",
//         url:
//             "/inventory_qte?waerhouse_id=" +
//             waerhouse_id +
//             "&material_id=" +
//             item["material_id"],
//         dataType: "json", // added data type
//         success: function (res) {
//             quantity = res;

//             console.log(quantity);
//             add_equipmentRow_with_info_pressEnter(
//                 "addPurchaseItem",
//                 item["material_id"],
//                 item["material_name"],
//                 item["material_number"],
//                 item["price"],
//                 item["earning_per"],
//                 item["currency"],
//                 item["end_date"],
//                 quantity
//             );
//         },
//         error: function (res) {
//             console.log("error_issam");
//             console.log("resss :" + res);
//         },
//     });
// }

// // get current quantity for sell bills
// function get_current_quantity_sell(waerhouse_id, item) {
//     console.log(waerhouse_id);
//     $.ajax({
//         type: "GET",
//         url:
//             "/inventory_qte?waerhouse_id=" +
//             waerhouse_id +
//             "&material_id=" +
//             item["material_id"],
//         dataType: "json", // added data type
//         success: function (res) {
//             quantity = res;

//             console.log(quantity);
//             add_equipmentRow_with_info_pressEnter_sell(
//                 "addPurchaseItem",
//                 item["material_id"],
//                 item["material_name"],
//                 item["material_number"],
//                 item["price"],
//                 item["earning_per"],
//                 item["currency"],
//                 quantity
//             );
//         },
//         error: function (res) {
//             console.log("error_issam");
//             console.log("resss :" + res);
//         },
//     });
// }
$(document).on(
    "input",
    'input[name="price[]"], input[name="material_number[]"]',
    function () {
        var materialNumberInput = $(this);
        var materialNumber = parseFloat(materialNumberInput.val());
        var errorFeedback = materialNumberInput.siblings(".invalid-feedback");

        if (isNaN(materialNumber) || materialNumber < 0) {
            materialNumberInput.addClass("is-invalid");
            errorFeedback.text("الرجاء إدخال عدد صالح وغير سالب.");
        } else {
            materialNumberInput.removeClass("is-invalid");
            errorFeedback.text("");
        }

        // Find the closest row that contains the input fields
        var row = materialNumberInput.closest("tr");

        // Get the price and quantity inputs for this row
        var priceInput = parseFloat(row.find('input[name="price[]"]').val());
        var quantityInput = parseFloat(
            row.find('input[name="material_number[]"]').val()
        );

        // Check if both price and quantity are valid numbers
        if (
            !isNaN(priceInput) &&
            !isNaN(quantityInput) &&
            priceInput >= 0 &&
            quantityInput >= 0
        ) {
            // Calculate the total
            var total = priceInput * quantityInput;
            // Update the corresponding total field within the same row
            row.find('input[name="total[]"]').val(total.toFixed(2));
        } else {
            // If either price or quantity is invalid, clear the corresponding total field within the same row
            row.find('input[name="total[]"]').val(0);
        }
        var sumTotalSyr = 0;
        var sumTotalDollar = 0;

        $('input[name="total[]"]').each(function (index) {
            var totalValue = parseFloat($(this).val());
            var currencyValue = $('input[name="currency[]"]').eq(index).val();

            if (!isNaN(totalValue) && totalValue >= 0) {
                if (currencyValue === "سوري") {
                    sumTotalSyr += totalValue;
                } else if (currencyValue === "دولار") {
                    sumTotalDollar += totalValue;
                }
            }
        });

        // Update the input fields with the calculated sums
        $('input[name="sumTotal_syr"]').val(sumTotalSyr.toFixed(2));
        $('input[name="sumTotal_dollar"]').val(sumTotalDollar.toFixed(2));
    }
);
