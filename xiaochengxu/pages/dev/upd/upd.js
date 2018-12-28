import { Base } from '../../../util/base.js';
var base = new Base();

Page({
  data: {
    addrIndex: 0,
    addrs: [
      {
        id: 1,
        name: '美宜佳'
      },
      {
        id: 2,
        name: '壹加壹'
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
