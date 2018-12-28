Page({
  data: {
    addrTypesIndex:0,
    region: ['广东省', '中山市', '全部'],
  },
  onLoad:function(){
    var df = [{id:"",name:"请选择"}];
    var addrTypes = [
      {
        id: 0,
        name: '旅游区'
      },
      {
        id: 1,
        name: '商城'
      }
    ];
    this.setData({
      addrTypes: df.concat(addrTypes)
    })
  },
  onReg:function(e){
    wx.reLaunch({
      url: '../login/login',
    })
  },
  onRegionChange: function (e) {
    this.setData({
      region: e.detail.value
    })
  },
  onAddrTypeChange: function (e) {
    this.setData({
      addrTypesIndex: e.detail.value
    })
  }
})
