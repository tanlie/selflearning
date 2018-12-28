import{ Base } from '../../../util/base.js';
var base = new Base();

Page({
  data: {
    date:'2018-11-1',
    dateTypesByAddr: [
      {
        value: '2018-11-01~2018-11-01',
        name: "今天",
        checked: true
      },
      {
        value: '2018-10-31~2018-10-31',
        name: "昨天"
      },
      {
        value: '2018-10-29~2018-10-4',
        name: "本周"
      },
      {
        value: '2018-11-01~2018-11-30',
        name: "本月"
      },
      {
        value: '2018-10-01~2018-10-31',
        name: "上月"
      }
    ],
    dateTypesByUser: [
      {
        value: '2018-11-01~2018-11-01',
        name: "今天",
        checked: true
      },
      {
        value: '2018-10-31~2018-10-31',
        name: "昨天"
      },
      {
        value: '2018-10-29~2018-10-4',
        name: "本周"
      },
      {
        value: '2018-11-01~2018-11-30',
        name: "本月"
      },
      {
        value: '2018-10-01~2018-10-31',
        name: "上月"
      }
    ],
    index: 1,
    tabs: [
      {
        index: '0',
        title: '按会员统计',
        img: '../../../lib/img/d_zhu'
      },
      {
        index: '1',
        title: '按地址统计',
        img: '../../../lib/img/d_dizhi'
      },
      {
        index: '2',
        title: '按时间统计',
        img: '../../../lib/img/d_shijian'
      }
    ],
    bytimeAddrIndex: 0,
    byuserAddrIndex: 0,
    addrs:[
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
    ]
  },
  onLoad:function(){
    var tabs = this.data.tabs;
    tabs[this.data.index].curr = "curr";
    this.setData({
      tabs: tabs
    });
  },
  onDateTypesByAddrChange: function (e) {
    base.changeRadios(this, "dateTypesByAddr", e.detail.value);
  },
  onDateTypesByUserChange: function (e) {
    base.changeRadios(this, "dateTypesByUser", e.detail.value);
  },
  onTabsChange(e) {
    let index = e.currentTarget.dataset.index;
    base.changeTabs(this,"tabs","index",index);
  },
  onSwiperChange(e) {
    base.changeTabs(this, "tabs", "index",e.detail.current);
  },
  onAddrByUserChange: function (e) {
    this.setData({
      byuserAddrIndex: e.detail.value
    })
  },
  onAddrByTimeChange: function (e) {
    this.setData({
      bytimeAddrIndex: e.detail.value
    })
  },
})