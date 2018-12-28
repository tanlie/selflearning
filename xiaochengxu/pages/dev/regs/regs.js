import { Base } from '../../../util/base.js'
var base = new Base();
 
Page({
  data: {
    subs:[
      {
        value:1,
        name:"1",
        disabled:"false"
      },
      {
        value: 2,
        name: "2"
      },
      {
        value: 3,
        name: "3"
      },
      {
        value: 4,
        name: "4"
      },
      {
        value: 5,
        name: "5"
      }
    ]
  },
  onLoad:function(){
  },
  onSubsChange: function (e) {
    base.changeRadios(this, "subs", e.detail.value);
  },
  onReg:function(e){
    wx.reLaunch({
      url: '../login/login',
    })
  }
})
