import { Config } from 'config.js';

function arrSort(params)
{

  var str = '';
  var key = [];
  for (var index in params){
      key.push(index);
  }
  key.sort();

  var str = '';
  for(var i=0;i<key.length;i++){
      str += key[i] + "=" + params[key[i]] + "&";
  }
  str += "key=" + Config.key;
 
  return str;
}

module.exports = {
  arrSort: arrSort
};