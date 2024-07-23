var list;

function insert_with_barcode_movement(e) {
    if (e.which == 13 || e.keyCode == 13) {
        _barcode = document.getElementById("barcode_ajax").value;
        var name_material_display = document.getElementById(
            "name_material_display"
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
                      name_material_display.innerHTML =
                            "لايوجد مادة بهذا الباركود " + _barcode;
                        document.getElementById("material_id_hidden").value = -1;
                        document.getElementById("barcode_ajax").value="";
                    } else {
                        document.getElementById("barcode_ajax").value="";
                        name_material_display.innerHTML = "";
                        if (Object.keys(list).length > 1) {
                          name_material_display.innerHTML =
                                "يوجد " +
                                Object.keys(list).length +
                                " بنفس رقم الباركود";
                            document.getElementById(
                                "material_id_hidden"
                            ).value = -1;
                        } else {
                            item = list[0];
                            name_material_display.innerHTML =
                                item["barcode"] +
                                " - " +
                                item["name"] +
                                " - " +
                                item["category_name"];
                            document.getElementById(
                                "material_id_hidden"
                            ).value = item["material_id"];
                      
                        }
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

function autoCompleteMedicine_Name_movement(id_father, id_children) {
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
                            '<option value="' + item["name"] + '">' + item['barcode'] + " - " + item['category_name'] + '</option>';
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

function insert_with_medicine_name_movement(e) {
    if (e.which == 13 || e.keyCode == 13) {
        _material_name = document.getElementById("material_name_ajax").value;
        var name_material_display = document.getElementById(
            "name_material_display"
        );

        if (_material_name.length >= 3) {
            if (Object.keys(list).length == 0) {
              name_material_display.innerHTML = "لايوجد مادة بهذا الاسم "+_material_name;
                document.getElementById("material_id_hidden").value = -1;
            } else {
                document.getElementById("material_name_ajax").value="";
                name_material_display.innerHTML = "";
                if (Object.keys(list).length > 1) {
                  name_material_display.innerHTML =
                        "يوجد " + Object.keys(list).length + " بنفس الاسم "+_material_name;
                    document.getElementById("material_id_hidden").value = -1;
                document.getElementById("material_name_ajax").value=_material_name;
                } else {
                    item = list[0];
                    name_material_display.innerHTML =
                        item["barcode"] +
                        " - " +
                        item["name"] +
                        " - " +
                        item["category_name"];
                    document.getElementById("material_id_hidden").value =
                        item["material_id"];
                }
            }
        }
    }
}

//movement for equipment

var list_equipment;

function autoCompleteBarcode_Equipment_movement(id_father, id_children) {
    _barcode = document.getElementById(id_father).value;
    barcodes = document.getElementById(id_children);
    barcodes.innerHTML = "";
    //alert(_barcode);
    if (_barcode.length >= 3) {
        $.ajax({
            type: "GET",
            url: "/autoCompleteBarcode_Equipment?barcode=" + _barcode,
            dataType: "json", // added data type
            // data: JSON.stringify({
            //     barcode: _barcode,
            // }),
            success: function (res) {
                list_equipment = res;
                if (res) {
                    res.forEach((item) => {
                        barcodes.innerHTML +=
                            '<option value="' + item["barcode"] + '">';
                    });
                    // alert(JSON.stringify(res));
                }
                //alert(res);
            },
            error: function (res) {
                // console.log(res);
                // alert(JSON.stringify(res));
                // alert(res);
            },
        });
    }
}

function insert_with_barcode_equipment_movement(e) {
    if (e.which == 13 || e.keyCode == 13) {
        _barcode = document.getElementById("barcode_ajax").value;
        var name_equipment_display = document.getElementById(
            "name_equipment_display"
        );

        if (_barcode.length >= 3) {
            $.ajax({
                type: "GET",
                url: "/autoCompleteBarcode_Equipment?barcode=" + _barcode,
                dataType: "json", // added data type

                success: function (res) {
                    list = res;
                    console.log(res);

                    //alert(Object.keys(list).length);
                    if (Object.keys(list).length == 0) {
                        name_equipment_display.innerHTML =
                            "لايوجد معدة بهذا الباركود "+_barcode;
                        document.getElementById("equipment_id_hidden").value = -1;
                        document.getElementById("barcode_ajax").value="";

                    } else {
                        document.getElementById("barcode_ajax").value="";
                        name_equipment_display.innerHTML = "";
                        if (Object.keys(list).length > 1) {
                            name_equipment_display.innerHTML =
                                "يوجد " +
                                Object.keys(list).length +
                                " بنفس رقم الباركود "+_barcode;
                            document.getElementById(
                                "equipment_id_hidden"
                            ).value = -1;
                        document.getElementById("barcode_ajax").value=_barcode;
                        } else {
                            item = list[0];
                            name_equipment_display.innerHTML =
                                item["barcode"] +
                                " - " +
                                item["equipment_name"];
                            document.getElementById(
                                "equipment_id_hidden"
                            ).value = item["equipment_id"];
                        }
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

function autoCompleteEquipment_Name_movement(id_father, id_children) {
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

function insert_with_equipment_name_movement(e) {
    if (e.which == 13 || e.keyCode == 13) {
        _equipment_name = document.getElementById("equipment_name_ajax").value;
        var name_equipment_display = document.getElementById(
            "name_equipment_display"
        );

        if (_equipment_name.length >= 3) {
            if (Object.keys(list_equipment).length == 0) {
                name_equipment_display.innerHTML = "لايوجد معدة بهذا الاسم " + _equipment_name;
                document.getElementById("medicine_id_hidden").value = -1;
            } else {
                document.getElementById("equipment_name_ajax").value="";
                name_equipment_display.innerHTML = "";
                if (Object.keys(list_equipment).length > 1) {
                    name_equipment_display.innerHTML =
                        "يوجد " + Object.keys(list_equipment).length + " معدة بنفس الاسم "+_equipment_name;
                    document.getElementById("equipment_id_hidden").value = -1;
                document.getElementById("equipment_name_ajax").value=_medicine_name;

                } else {
                    item = list_equipment[0];
                    name_equipment_display.innerHTML =
                        item["barcode"] +
                        " - " +
                        item["equipment_name"];
                    document.getElementById("equipment_id_hidden").value =
                        item["equipment_id"];
                }
            }
        }
    }
}
