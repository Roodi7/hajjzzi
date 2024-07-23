
function autoCompleteMedicine_Name_damage(id_father, id_children) {
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
                list = res;
                if (res) {
                    res.forEach((item) => {
                      material_name.innerHTML +=
                            '<option value="' + item['name'] + '">' + item["barcode"] + " - " + item['category_name'] + '</option>';
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

function insert_with_barcode_damage(e) {

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

                        _waerhouse_id =
                            document.getElementById("waerhouse_id").value;

                        list.forEach((item) => {
                            if (item["barcode"] == _barcode) {
                                get_current_quantity_damage(_waerhouse_id, item);
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

function insert_with_barcode_damage_for_name(e) {

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
                  get_current_quantity_damage(_from_waerhouse_id, item);
                }
            });
        }
    }
}
}

function add_purchaseRow_with_info_pressEnter_damage(
    divName,
    material_id,
    waerhouse_id,
    barcode,
    name,
    category_name,
    quantity,
) {
    // var optionval = $("#leaf_type_dropdown").val();
    var row = $("#purchaseTable tbody tr").length;
    var count = row + 1;
    var newdiv = document.createElement("tr");

    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow(this)"><i style="font-size: 22px;color:red;" class="bi bi-trash"></i></button></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' + barcode + ' <input hidden type="text"  name="barcode[]" readonly  class="form-control text-right" placeholder="الباركود"  value="' +
        barcode +
        '" /></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' + name + ' <input hidden type="text"  name="name[]" readonly class="form-control text-right" placeholder="اسم المادة" value="' +
        name +
        '" /><input hidden  name="material_id[]" value="' +
        material_id +
        '"  /></td>';
    newdiv.innerHTML +=
        '<td class="text-center"> ' + category_name + '<input hidden type="text"  name="category_name[]" readonly  class="form-control text-right"  placeholder="اسم الصنف"  value="' +
        category_name +
        '" /></td>';
    newdiv.innerHTML +=
        '<td class="text-right" style="width:120px;"><input type="number" min="1" name="count[]"  class="form-control text-right valid_number"  style="max-width:120px;"  placeholder="0.00" value="" required /></td>';

    newdiv.innerHTML +=
        '<td class="text-center">' + quantity + '<input hidden type="number" min="1" name="current_quantity"  class="form-control text-right valid_number"  placeholder="0.00" value="' + quantity + '" required readonly /></td>';
    newdiv.innerHTML +=
        '<td class="text-center"><input type="text" name="reason[]"  class="form-control datepicker"  required  placeholder="السبب"/> </td>';
    document.getElementById(divName).prepend(newdiv);

    count++;

}

function insert_with_medicine_name_damage(e) {
    if (e.which == 13 || e.keyCode == 13) {
        _medicine_name = document.getElementById("medicine_name_ajax").value;
        var messge_error_name = document.getElementById("messge_error_name");

        if (_medicine_name.length >= 3) {
            if (Object.keys(list).length == 0) {
                messge_error_name.innerHTML = "لايوجد مادة بهذا الاسم " + _medicine_name;
            } else {
                document.getElementById("medicine_name_ajax").value = "";
                messge_error_name.innerHTML = "";
                if (Object.keys(list).length > 1) {
                    messge_error_name.innerHTML =
                        "يوجد " + Object.keys(list).length + " مادة بنفس الاسم " + _medicine_name;
                    document.getElementById("medicine_name_ajax").value = _medicine_name;
                }
                _from_repository_id =
                    document.getElementById("repository_id").value;

                list.forEach((item) => {
                    if (item["medicine_name"] == _medicine_name) {
                        get_current_quantity_damage(_from_repository_id, item);
                    }
                });
            }
        }
    }
}

function insert_with_barcode_equipment_transfer_damage(e) {

    if (e.which == 13 || e.keyCode == 13) {
        _barcode = document.getElementById("barcode_ajax").value;
        var messge_error_barcode = document.getElementById(
            "messge_error_barcode"
        );
        _from_repository_id = document.getElementById("repository_id").value;
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
                            document.getElementById("repository_id").value;
                        list.forEach((item) => {
                            // console.log(item['equipment_id']);
                            if (item["barcode"] == _barcode) {
                                get_current_quantity_damage_equipment(_from_repository_id, item);
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

function autoCompleteEquipment_Name_damage(id_father, id_children) {
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


function insert_with_equipment_name_transfer_damage(e) {
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
                        "يوجد " + Object.keys(list_equipment).length + " معدة بنفس الاسم ";
                    document.getElementById("equipment_name_ajax").value = _equipment_name;
                }
                _from_repository_id =
                    document.getElementById("repository_id").value;

                list_equipment.forEach((item) => {
                    if (item["equipment_name"] == _equipment_name) {
                        get_current_quantity_damage_equipment(_from_repository_id, item);
                    }
                });
            }
        }
    }
}

function add_EqipmentRow_with_info_pressEnter_transfer_damage(
    divName,
    equipment_id,
    barcode,
    equipment_name,
    quantity

) {
    console.log(quantity);
    var row = $("#equipmentTable tbody tr").length;
    var count = row + 1;
    var newdiv = document.createElement("tr");
    newdiv.innerHTML +=
        '<td class="text-center"><button type="button" class="btn"  onclick="deleteRow(this)"><i style="font-size: 22px;color:red;" class="bi bi-trash"></i></button></td>';
    newdiv.innerHTML +=
        '<td class="text-center"> ' + barcode + '<input type="text" hidden  name="barcode[]" readonly class="form-control text-right" placeholder="الباركود"  value="' + barcode + '" /></td>';
    newdiv.innerHTML +=
        '<td class="text-center">' + equipment_name + ' <input type="text" hidden name="equipment_name[]" readonly class="form-control text-right" placeholder="اسم الأادة" value="' + equipment_name + '" /><input hidden  name="equipment_id[]" value="' + equipment_id + '"  /></td>';
    newdiv.innerHTML +=
        '<td class="text-right" style="width:120px;"><input type="number" min="1" name="count[]" class="form-control text-right valid_number" style="max-width:120px;"  placeholder="0.00" required /></td>';
    newdiv.innerHTML +=
        '<td class="text-center"  >' + quantity + '<input type="number" hidden name="current_quantity"  class="form-control text-right valid_number"value="' +
        quantity +
        '"  placeholder="0.00" readonly/></td>';

    newdiv.innerHTML +=
        '<td><input type="text" name="reason[]"  class="form-control datepicker"  required  placeholder="السبب"/> </td>';
    document.getElementById(divName).prepend(newdiv);
    count++;
}




// get current quantity for medicine
function get_current_quantity_damage(waerhouse_id, item) {
    $.ajax({
        type: "GET",
        url: "/inventory?waerhouse_id=" +
              waerhouse_id +
            "&material_id=" +
            item["material_id"],
        dataType: "json", // added data type

        success: function (res) {
            quantity = res;
            console.log(quantity);
            add_purchaseRow_with_info_pressEnter_damage(
                "addPurchaseItem",
                item["material_id"],
                waerhouse_id,
                item["barcode"],
                item["name"],
                item["category_name"],
                quantity,
            );
        },
        error: function (res) {
            console.log("resss :" + res);
        },
    });
}




// get current quantity for equipment
function get_current_quantity_damage_equipment(repository_id, item) {
    $.ajax({
        type: "GET",
        url: "/inventoryequipment?repository_id=" + repository_id + "&equipment_id=" + item['equipment_id'],
        dataType: "json",
        success: function (res) {
            quantity = res;
            add_EqipmentRow_with_info_pressEnter_transfer_damage(
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
