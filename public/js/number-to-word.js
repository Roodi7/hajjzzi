const ones = [
    "",
    "واحد",
    "اثنان",
    "ثلاثة",
    "أربعة",
    "خمسة",
    "ستة",
    "سبعة",
    "ثمانية",
    "تسعة",
];
const tens = [
    "",
    "عشرة",
    "عشرون",
    "ثلاثون",
    "أربعون",
    "خمسون",
    "ستون",
    "سبعون",
    "ثمانون",
    "تسعون",
];
const scales = [
    "",
    "ألف",
    "مليون",
    "مليار",
    "تريليون",
    "كوادريليون",
    "كوينتريليون",
    "سكستريليون",
    "سبتيليون",
    "أوكتيليون",
];

function convertNumberToArabicWords(number) {
    if (number === 0) {
        return "صفر";
    }

    let result = "";

    for (let i = 0; number > 0; i++) {
        const currentScale = number % 1000;
        if (currentScale !== 0) {
            result = `${convertThreeDigitScale(currentScale)} ${
                scales[i]
            } ${result}`;
        }
        number = Math.floor(number / 1000);
    }

    return result.trim();
}

function convertThreeDigitScale(number) {
    const hundred = Math.floor(number / 100);
    const ten = Math.floor((number % 100) / 10);
    const one = number % 10;

    let result = "";

    if (hundred !== 0) {
        result += `و${ones[hundred]} مائة`;
    }

    if (ten === 1 && one > 0) {
        result += ` و${ones[10 + one]}`;
    } else if (ten > 1) {
        if (one !== 0) {
            result += ` و${ones[one]}`;
        }
        result += ` و${tens[ten]}`;
    } else if (one !== 0) {
        result += `${ones[one]}`;
    }

    return result.trim();
}

function NumberToWord() {
    const amount = document.getElementById("amount").value;
    document.getElementById("amount_in_writing").value =
        convertNumberToArabicWords(amount);
    // alert(number);
}
// // مثال الاستخدام
// const number = 123456789;
// const words = convertNumberToArabicWords(number);
// console.log(words);
