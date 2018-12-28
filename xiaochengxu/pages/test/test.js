import { Base } from '../../util/base.js';
var base = new Base();

Page({

  /**
   * 页面的初始数据
   */
  data: {
    listPage:1,
    listLook:false,
    list:[],

    downLoadData: {
      downLoad: false,
      downLoadOver: false
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

    /*var data = {
      page_no: this.data.listPage,
      page_row: 10
    }
    base.listMore(this, 'com/index/itemlist', data);*/
  },
  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
    console.log("111");
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
    /*console.log(this.data.listPage);
    var data = {
      page_no: this.data.listPage,
      page_row: 20
    }
    base.listMore(this, 'com/index/itemlist', data);*/
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})