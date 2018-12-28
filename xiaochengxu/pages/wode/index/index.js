import { Base } from '../../../util/base.js';
var base = new Base();

Page({
  data: {
    addrs: [
      {
        id: 1,
        name: '美宜佳',
        tot:3,
        online:0
      },
      {
        id: 2,
        name: '壹加壹',
        tot: 6,
        online: 6
      }
    ]
  },
  bindInput: function (e) {
    this.data[e.currentTarget.dataset.name] = e.detail.value;
  },

  onAddrChange: function (e) {
    this.setData({
      addrIndex: e.detail.value
    })
  },
})
