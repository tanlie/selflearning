import { Base } from '../../util/base.js';
var base = new Base();

Page({
  data: {
    index:0,
    tabs: [
      {
        index: '0',
        title: '今日收益',
        img: '../../lib/img/b_jinbi',
        curr: 'curr'
      },
      {
        index: '1',
        title: '今日启动',
        img: '../../lib/img/b_wifi',
        curr: ''
      }
    ],
    grids:[
      {
        key:'zhuche',
        title:'设备注册',
        desc:'扫描设备二维码',
        img: "../../lib/img/c_saomiao.png",
        url: "../dev/regs/regs"
      },
      {
        key: 'shouyi',
        title: '收益统计',
        desc: '实时收益报告',
        img: "../../lib/img/c_shouyi.png",
        url: "../income/index/index"
      },
      {
        key: 'shebei',
        title: '设备管理',
        desc: '5台，在线2台',
        img: "../../lib/img/c_shebei.png",
        url: "../dev/index/index"
      },
      {
        key: 'shezhi',
        title: '账号设置',
        desc: '投放地址，密码',
        img: "../../lib/img/c_shezhi.png",
        url: "../wode/index/index"
      }
    ],
    comfooter: {
      ver_no: 'v-1.0.0',
      phone_no: '0760-88888888'
    }
  },
  onTabsChange(e) {
    let index = e.currentTarget.dataset.index;
    base.changeTabs(this, "tabs", "index", index);
  },
  onTapLeft(e) {
    let index = this.data.index;
    if(index > 0){
      index--;
      base.changeTabs(this, "tabs", "index", index);
    }
  },
  onTapRight(e) {
    let max = this.data.tabs.length - 1;
    let index = this.data.index;
    if (index < max) {
      index++;
      base.changeTabs(this, "tabs", "index", index);
    }
  },
  onSwiperChange(e) {
    base.changeTabs(this, "tabs", "index", e.detail.current);
  },

  /*test:function(){
    var url =  "http://self.cc/getuser";
    wx.request({
      url: url,
      method : 'get',
      data : {},
      success:function(res){
          console.log(res.data);
      }
    })

  }*/


})
