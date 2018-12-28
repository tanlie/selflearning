import { Base } from '../../../util/base.js'
var base = new Base();
 
Page({
  data: {
    addrIndex: 0,
    addrs: [
      {
        id: 0,
        name: '全部（4个）'
      },
      {
        id: 1,
        name: '美宜佳'
      },
      {
        id: 2,
        name: '壹加壹'
      }
    ],
    onlineType: [
      {
        value: '',
        name: "全部",
        checked: true
      },
      {
        value: '1',
        name: "在线 6"
      },
      {
        value: '0',
        name: "离线 0"
      }
    ],
  },
  onLoad:function(){
  },
  onlineTypesChange: function (e) {
    base.changeRadios(this, "onlineType", e.detail.value);
  },
})
