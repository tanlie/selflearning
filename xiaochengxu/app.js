import { hexMD5 } from 'util/md5.js';
 

App({
  onLaunch: function () {
    wx.login({
     

      // success : res=>{},
      success : function(res){
        wx.setStorageSync('code', res.code);
        var str = "device_id%3D66901022%26img_url%3Dhttp%3A%2F%2Fallonyun.oss-cn-shenzhen.aliyuncs.com%2F00000001%2Fmember%2F2101500788_01.jpg%26mem_age%3D0%26mem_hint%3DWelcome%26mem_name%3D%E4%B8%87%E8%B1%A1%E4%BA%91%E7%AB%AF%26mem_no%3D2101500788%26mem_sex%3DM%26mem_sort%3D%E6%99%AE%E9%80%9A%E4%BC%9A%E5%91%98%E5%8D%A1%26timestamp%3D1541599590%26url_type%3D1%26key%3Da479afd73bd203272a9cb36c050a2e5e";
      str = hexMD5(str);

       
        console.log(str);
        /*var token = wx.getStorageSync("token");
        if (token == "") {
          wx.reLaunch({
            url: '/pages/login/login',
          })
        }*/
      }
    })
  }
})