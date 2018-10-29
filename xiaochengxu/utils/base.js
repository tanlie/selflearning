import { Config } from 'config.js';

class Base {
  constructor(){
    "use strict";
    this.baseRestUrl = Config.BaseUrl;
  }

  //http 请求类, 当noRefech为true时，不做未授权重试机制
  request(params){
      var that = this,
          url = this.baseRestUrl + params.url;
      //默认请求方式
      if(!params.type){
            params.type = 'get';
      }
      //选择url来源，绝对路径还是相对路径
      if(params.setUpUrl == false){
          url = params.url;
      }

      wx.request({
        url: url,
        data : params.data,
        method : params.type,
        header : {
          'content-type' : 'application/json',
          'token' : wx.getStorageSync('token')
        },
        success : function(res){
          // params.sCallback && sCallback(res.data);
           if(params.sCallback){
             return params.sCallback(res.data);
            } 
        }
      })
  }
}

export { Base }