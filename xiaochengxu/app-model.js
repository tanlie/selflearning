import { Base } from '/utils/base.js';

class MyApp extends Base{
  constructor(){
    super();
  }

  setToken(code,callback){
    var url = this.baseRestUrl + 'getToken';
     wx.request({
       url: url,
       data : {
         code : code
        },
        method : 'post',
        success : function(res){
          //console.log(res.data);
          wx.setStorageSync('token', res.data.token)
          callback && callback(res.data);
        }
     })
  }

  updateUserInfo(data,callback)
  {
    var params = {
      url : 'updateUserInfo',
      type : 'post',
      data : data,
      sCallback : function(res){
        callback && callback(res);
      }
    };
    this.request(params);
  }


}

export { MyApp };