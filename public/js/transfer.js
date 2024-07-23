var list;
function autoCompleteMedicine_Name_transfer(id_father, id_children) {
    _material_name = document.getElementById(id_father).value;
    material_name = document.getElementById(id_children);
    material_name.innerHTML = "";
    //alert(_medicine_name);
    if (_material_name.length >= 3) {
        $.ajax({
            type: "GET",
            url: "/autoCompleteMaterial_Name?material_name=" + _material_name,
            dataType: "json", // added data type
            // data: JSON.stringify({
            //     medicine_name: _medicine_name,
            // }),
            success: function (res) {
                list = list_item = res;
                if (res) {
                    res.forEach((item) => {
                      material_name.innerHTML +=
                      '<option value="' + item['name'] + '"> ' + item["barcode"] + " - " + item['category_name'] + '</option>';
                    });
                    //  alert(JSON.stringify(res));
                }
                //alert(res);
            },
            error: function (res) {
                // console.log(res);
                //alert(JSON.stringify(res));
                //alert(res);
            },
        });
    }
}
function insert_with_barcode_transfer(e) {
    if (e.which == 13 || e.keyCode == 13) {
        _barcode = document.getElementById("barcode_ajax").value;
        var messge_error_barcode = document.getElementById(
            "messge_error_barcode"
        );

        if (_barcode.length >= 3) {
            $.ajax({
                type: "GET",
                url: "/getAutoCompleteBarcode?barcode=" + _barcode,
                dataType: "json", // added data type
                // data: JSON.stringify({
                //     barcode: _barcode,
                // }),

                success: function (res) {
                    list = res;
                    console.log(res);

                    //alert(Object.keys(list).length);
                    if (Object.keys(list).length == 0) {
                        messge_error_barcode.innerHTML =
                            "لايوجد مادة بهذا الباركود " + _barcode;
                        document.getElementById("barcode_ajax").value = "";
                    } else {
                        document.getElementById("barcode_ajax").value = "";
                        messge_error_barcode.innerHTML = "";
                        if (Object.keys(list).length > 1) {
                            messge_error_barcode.innerHTML =
                                "يوجد " +
                                Object.keys(list).length +
                                " مادة بنفس رقم الباركود " + _barcode;
                        }

                        _from_waerhouse_id =
                            document.getElementById("from_waerhouse_id").value;

                        list.forEach((item) => {
                            if (item["barcode"] == _barcode) {
                                get_current_quantity(_from_waerhouse_id, item);
                            }
                        });
                    }
                },
                error: function (res) {
                    console.log(res);
                    alert(JSON.stringify(res));
                },
            });
        }
    }
}

function insert_with_barcode_transfer_for_name(e) {
  if (e.which == 13 || e.keyCode == 13) {
    _material_name = document.getElementById("material_name_ajax").value;
    var messge_error_name = document.getElementById("messge_error_name");

    if (_material_name.length >= 3) {
        if (Object.keys(list).length == 0) {
            messge_error_name.innerHTML = "لايوجد مادة بهذا الاسم " + _material_name;
        } else {
            document.getElementById("material_name_ajax").value = "";
            messge_error_name.innerHTML = "";
            if (Object.keys(list).length > 1) {
                console.log(list);
                messge_error_name.innerHTML =
                    "يوجد " + Object.keys(list).length + " مادة بنفس الاسم " + _material_name;
                document.getElementById("material_name_ajax").value = _material_name;
            }
            _from_waerhouse_id =
                document.getElementById("from_waerhouse_id").value;

            list.forEach((item) => {
                if (item["name"] == _material_name) {
                  get_current_quantity(_from_waerhouse_id, item);
                }
            });
        }
    }
}
}



var list_item;

function insert_with_medicine_name_transfer(e) {
  if (e.which == 13 || e.keyCode == 13) {
    _material_name = document.getElementById("material_name_ajax").value;
    var messge_error_name = document.getElementById("messge_error_name");

    if (_material_name.length >= 3) {
        if (Object.keys(list).length == 0) {
            messge_error_name.innerHTML = "لايوجد مادة بهذا الاسم " + _material_name;
        } else {
            document.getElementById("material_name_ajax").value = "";
            messge_error_name.innerHTML = "";
            if (Object.keys(list).length > 1) {
                console.log(list);
                messge_error_name.innerHTML =
                    "يوجد " + Object.keys(list).length + " مادة بنفس الاسم " + _material_name;
                document.getElementById("material_name_ajax").value = _material_name;
            }
            _from_waerhouse_id =
                document.getElementById("waerhouse_id").value;

            list.forEach((item) => {
                if (item["name"] == _material_name) {
                    get_current_quantity_input(_from_waerhouse_id, item);
                }
            });
        }
    }
}
}


//add medicine row to table
function add_purchaseRow_with_info_pressEnter_transfer(
    divName,
    material_id,
    waerhouse_id,
    barcode,
    name,
    category_name,
    quantity
) {
    var row = $("#purchaseTable tbody tr").length;
    var count = row + 1;
    var newdiv = document.createElement("tr");

    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow(this)"><i style="font-size: 22px;color:red;" class="bi bi-trash"></i></button></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' + barcode + ' <input hidden type="text"  name="barcode[]" readonly  class="form-control" placeholder="الباركود"  value="' +
        barcode + '" /></td>';

    newdiv.innerHTML +=
        '<td class="text-center"> ' + name + ' <input hidden type="text"  name="name[]" readonly class="form-control" placeholder="اسم المادة" value="' +
        name + '" /><input hidden  name="material_id[]" value="' + material_id + '"  /></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' + category_name + '  <input hidden type="text"  name="category_name[]" readonly  class="form-control"  placeholder="اسم الصنف"  value="' +
        category_name + '" /></td>';

    newdiv.innerHTML +=
        '<td class="text-right"><input type="number" min="1" name="count[]"  class="form-control"   placeholder="0" value=""  step="1"  required /></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' + quantity + ' <input hidden type="text" name="amount_now[]" class="form-control"  required value="' +
        quantity + '" placeholder="الكمية الحالية" readonly/> </td>';

    document.getElementById(divName).prepend(newdiv);

    count++;
    // $(".datepicker").datepicker({
    //     dateFormat: "yy-mm-dd"
    // });
}

//transfer for equipment

var list_equipment;



function insert_with_barcode_equipment_transfer(e) {
    if (e.which == 13 || e.keyCode == 13) {
        _barcode = document.getElementById("barcode_ajax").value;
        var messge_error_barcode = document.getElementById(
            "messge_error_barcode"
        );
        _from_repository_id = document.getElementById("from_repository_id").value;
        if (_barcode.length >= 3) {
            $.ajax({
                type: "GET",
                url: "/autoCompleteBarcode_Equipment?barcode=" + _barcode,
                dataType: "json", // added data type
                // data: JSON.stringify({
                //     barcode: _barcode,
                // }),
                success: function (res) {
                    list = res;
                    console.log(res);

                    //alert(Object.keys(list).length);
                    if (Object.keys(list).length == 0) {
                        messge_error_barcode.innerHTML =
                            "لايوجد معدات  بهذا الباركود " + _barcode;
                        document.getElementById("barcode_ajax").value = "";
                    } else {
                        document.getElementById("barcode_ajax").value = "";
                        messge_error_barcode.innerHTML = "";
                        if (Object.keys(list).length > 1) {
                            messge_error_barcode.innerHTML =
                                "يوجد " +
                                Object.keys(list).length +
                                " معدة بنفس رقم الباركود " + _barcode;
                        }

                        _from_repository_id =
                            document.getElementById("from_repository_id").value;
                        list.forEach((item) => {
                            // console.log(item['equipment_id']);
                            if (item["barcode"] == _barcode) {
                                get_current_equipment_quantity(_from_repository_id, item);
                            }
                        });
                    }
                },
                error: function (res) {
                    console.log(res);
                    alert(JSON.stringify(res));
                },
            });
        }

        //alert("okkkkk");

        //alert(_equipment_name);
    }
}

function autoCompleteEquipment_Name_transfer(id_father, id_children) {
    _equipment_name = document.getElementById(id_father).value;
    equipment_name = document.getElementById(id_children);
    equipment_name.innerHTML = "";
    //alert(_equipment_name);
    if (_equipment_name.length >= 3) {
        $.ajax({
            type: "GET",
            url: "/autoCompleteEquipment_Name?equipment_name=" + _equipment_name,
            dataType: "json", // added data type
            // data: JSON.stringify({
            //     equipment_name: _equipment_name,
            // }),
            success: function (res) {
                list_equipment = res;
                if (res) {
                    res.forEach((item) => {
                        equipment_name.innerHTML +=
                            '<option value="' + item["equipment_name"] + '">';
                    });
                    //  alert(JSON.stringify(res));
                }
                //alert(res);
            },
            error: function (res) {
                // console.log(res);
                //alert(JSON.stringify(res));
                //alert(res);
            },
        });
    }
}

function insert_with_equipment_name_transfer(e) {


    if (e.which == 13 || e.keyCode == 13) {
        _equipment_name = document.getElementById("equipment_name_ajax").value;
        var messge_error_name = document.getElementById("messge_error_name");

        if (_equipment_name.length >= 3) {
            if (Object.keys(list_equipment).length == 0) {
                messge_error_name.innerHTML = "لايوجد معدة بهذا الاسم " + _equipment_name;
            } else {
                document.getElementById("equipment_name_ajax").value = "";
                messge_error_name.innerHTML = "";
                if (Object.keys(list_equipment).length > 1) {
                    messge_error_name.innerHTML =
                        "يوجد " + Object.keys(list_equipment).length + " معدة بنفس الاسم " + _equipment_name;
                    document.getElementById("equipment_name_ajax").value = _equipment_name;
                }
                _from_repository_id =
                    document.getElementById("from_repository_id").value;

                list_equipment.forEach((item) => {
                    if (item["equipment_name"] == _equipment_name) {
                        get_current_equipment_quantity(_from_repository_id, item);
                    }
                });
            }
        }
    }
}

function add_EqipmentRow_with_info_pressEnter_transfer(
    divName,
    equipment_id,
    barcode,
    equipment_name,
    equipment_quantity
) {
    // var optionval = $("#leaf_type_dropdown").val();
    var row = $("#equipmentTable tbody tr").length;
    var count = row + 1;
    var newdiv = document.createElement("tr");
    console.log("addd td ");

    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow_equipment(this)"><i style="font-size: 22px;color:red;" class="bi bi-trash"></i></button></td>';
    newdiv.innerHTML +=
        '<td class="text-center"> ' + barcode + '<input hidden type="text"  name="barcode[]" readonly  class="form-control text-right" placeholder="الباركود"  value="' +
        barcode + '" /></td>';

    newdiv.innerHTML +=
        '<td class="text-center"> ' + equipment_name + '<input hidden type="text"  name="equipment_name[]" readonly class="form-control text-right" placeholder="اسم الأاة" value="' +
        equipment_name + '" /><input hidden  name="equipment_id[]" value="' + equipment_id + '"  /></td>';

    newdiv.innerHTML +=
        '<td class="text-right" style="width:150px"><input  type="number" min="1" step="1" name="count[]" class="form-control text-right valid_number" style="max-width:150px"  placeholder="0.00" value=""  required/></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' + equipment_quantity + '<input hidden type="text" name="amount_now[]" id="amount_now" class="form-control datepicker" value="' + equipment_quantity + '" required  placeholder="الكمية الحالية" readonly/> </td>';

    document.getElementById(divName).prepend(newdiv);

    count++;
    // $(".datepicker").datepicker({
    //     dateFormat: "yy-mm-dd"
    // });
} // $(".datepicker").datepicker({
//     dateFormat: "yy-mm-dd"
// });

// get current quantity for medicine
function get_current_quantity(waerhouse_id, item) {
    $.ajax({
        type: "GET",
        url: "/inventory?waerhouse_id=" +
        waerhouse_id +
            "&material_id=" +
            item["material_id"],
        dataType: "json", // added data type
        // data: JSON.stringify({
        //     medicine_name: _medicine_name,
        // }),
        success: function (res) {
            quantity = res;
            add_purchaseRow_with_info_pressEnter_transfer(
                "addPurchaseItem",
                item["material_id"],
                waerhouse_id,
                item["barcode"],
                item["name"],
                item["category_name"],
                quantity
            );
        },
        error: function (res) {
            // console.log("resss :" + res);
        },
    });
}


// get current quantity for equipment
function get_current_equipment_quantity(repository_id, item) {
    $.ajax({
        type: "GET",
        url: "/inventoryequipment?repository_id=" + repository_id + "&equipment_id=" + item['equipment_id'],
        dataType: "json",
        success: function (res) {
            quantity = res;
            console.log("Q = " + quantity);
            add_EqipmentRow_with_info_pressEnter_transfer(
                "addPurchaseItem",
                item['equipment_id'],
                item['barcode'],
                item['equipment_name'],
                quantity,
            );
        },
        error: function (res) {
            console.log("resss :" + res);
        },
    });
}





function checkIfExistItem_equipment_transfer(e) {
    var t = $("#purchaseTable > tbody > tr").length;
    if (t == 0) {
        alert("يجب أن توجد مادة واحدة على الأقل.");
        return false;
    }
}
