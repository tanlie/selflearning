//app.js
import { MyApp } from 'app-model.js';
var myapp = new MyApp();

App({
  onLaunch: function () {
    // 展示本地存储能力
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)

    // 登录
    wx.login({
      success: res => {
        var that = this;
        // 发送 res.code 到后台换取 openId, sessionKey, unionId
        var params = {
          url : 'getmsgcode',
          
          type : 'POST',
          data : {
            mobile: '13811589793',
            timestamp : '123456',
            sign : 'sdfsdfsdsdf'
          },
          
          sCallback : function(res){
            console.log(res);
          }
        };

        myapp.request(params);




        //myapp.setToken(res.code,(data)=>{
        //    wx.setStorageSync('openid', data.openid)
        //    wx.setStorageSync('access_key', data.access_key)
        //});
      }
    })
    // 获取用户信息
    wx.getSetting({
      success: res => {
        if (res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称，不会弹框
          wx.getUserInfo({
            lang: 'zh_CN',
            success: res => {
              // 可以将 res 发送给后台解码出 unionId
              this.globalData.userInfo = res.userInfo
              myapp.updateUserInfo(res.userInfo,(res)=>{
               // console.log(res);
              });
              // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
              // 所以此处加入 callback 以防止这种情况
              if (this.userInfoReadyCallback) {
                this.userInfoReadyCallback(res)
              }
            }
          })
        }
      }
    })
  },
  
  globalData: {
    userInfo: '111',
    openid :'',
    session_key : ''
  }
})