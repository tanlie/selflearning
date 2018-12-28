Page({
  data: {
    comfooter: {
      ver_no: 'v-1.0.0',
      phone_no: '0760-88888888'
    }
  },
  onReg:function(e){
    wx.reLaunch({
      url: '../login/login',
    })
  }
})
