//index.js
//获取应用实例
const app = getApp()
//引入模型类，并实例化
import { Home } from 'index-model.js';
var home = new Home();

Page({
  data: {
    showModel : true
  },
  //事件处理函数
  bindViewTap: function() {
   
  },
  onLoad: function () {
    var test = wx.getStorageSync('token');
    var openid = wx.getStorageSync('openid');
    console.log(openid);
  },

  //初始化数据
  __loadData:function(){


  },


  getUserInfo: function(e) {
   
  },

  clickMe:function(){
    var url = "http://self.cc/getuser";
    var that = this;
    wx.request({
      url: url,
      data : {'openid':'123456789'},
      method : 'get',
      header : {
        'content-type' : 'application/json',
        'token' : 'dfapodfispodf'
      },
      success : function(res){
        console.log(res.data);
        that.setData({
          'msg1': res.data.msg
        });
      },
      fail : function(){

      }
    })

  },
  clickMe2:function(){
    home.getUserData((res)=>{
        console.log(res);
      this.setData({
        'msg2': res.msg
      });
    });
  }










})
