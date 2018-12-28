import { Base } from '../../util/base.js';

class Login extends Base {
  constructor(){
    super();
  }


  myLogin(input_data,callback){
      var params = {
        url  : "getUser",
        data : input_data,
        method : "get",
        sCallback: function(res){
           callback && callback(res);
         // if (callback){
         //    return callback(res);
         //  }
        }
      };
    this.request(params);
  }
  
}

export { Login };