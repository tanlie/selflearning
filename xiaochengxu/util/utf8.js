function UnicodeToUtf8(unicode) {
  var uchar;
  var utf8str = "";
  var i;
  for (i = 0; i < unicode.length; i += 2) {
    uchar = (unicode[i] << 8) | unicode[i + 1];
    utf8str = utf8str + String.fromCharCode(uchar);
  }
  return utf8str;
} 

function Utf8ToUnicode(strUtf8) {
  var i, j;
  var uCode;
  var temp = new Array();
  for (i = 0, j = 0; i < strUtf8.length; i++) {
    uCode = strUtf8.charCodeAt(i);
    if (uCode < 0x100) {         //ASCII字符 
      temp[j++] = 0x00;
      temp[j++] = uCode;
    } else if (uCode < 0x10000) {
      temp[j++] = (uCode >> 8) & 0xff;
      temp[j++] = uCode & 0xff;
    } else if (uCode < 0x1000000) {
      temp[j++] = (uCode >> 16) & 0xff;
      temp[j++] = (uCode >> 8) & 0xff;
      temp[j++] = uCode & 0xff;
    } else if (uCode < 0x100000000) {
      temp[j++] = (uCode >> 24) & 0xff;
      temp[j++] = (uCode >> 16) & 0xff;
      temp[j++] = (uCode >> 8) & 0xff;
      temp[j++] = uCode & 0xff;
    } else {
      break;
    }
  }
  temp.length = j;
  return temp;
}

