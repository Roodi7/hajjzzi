
var body_loadHander = function() {

  var crtOpt = function(value, label) {
    var opt = document.createElement('option');
    opt.appendChild(document.createTextNode(label) );
    opt.value = value;
    return opt;
  };

  var t = document.forms['qrForm'].elements['t'];
  t.appendChild(crtOpt('' + 0, 'Auto Detect') );
  for (var i = 1; i <= 40; i += 1) {
    t.appendChild(crtOpt('' + i, '' + i) );
  }
  t.value = '0';

  update_qrcode();
};

var draw_qrcode = function(text, typeNumber, errorCorrectionLevel) {
  document.write(create_qrcode(text, typeNumber, errorCorrectionLevel) );
};

var create_qrcode = function(text, typeNumber,
    errorCorrectionLevel, mode, mb) {

  qrcode.stringToBytes = qrcode.stringToBytesFuncs[mb];

  var qr = qrcode(typeNumber || 4, errorCorrectionLevel || 'M');
  qr.addData(text, mode);
  qr.make();

//  return qr.createTableTag();
//  return qr.createSvgTag();
  return qr.createImgTag();
};

function generateRandomString(length) {
  let result = '';
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

var update_qrcode = function(text) {
  text = text.replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
  document.getElementById('qr').innerHTML = create_qrcode(text, 8, 'M', 'Byte', 'UTF-8');
};
