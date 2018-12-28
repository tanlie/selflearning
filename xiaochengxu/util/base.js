import { Config } from 'config.js';
import { hexMD5 } from 'md5.js';
import { arrSort } from 'sort.js';

class Base {
  constructor(){
    this.restUrl = Config.baseUrl;
  }

  /*时间截 */
  getTimestamp(){
    var timestamp = Date.parse(new Date());
    timestamp = timestamp / 1000;
    return timestamp;
  }

  /*访问后台API */
  request(params){
    var url = Config.baseUrl +  params.url;
    if(params.setUrl){
        url = params.setUrl;
    }
    
    if (params.method){
      var method = params.method;
    } else {
      var method = 'get';
    }

    params.data.timestamp = this.getTimestamp();
    var str = arrSort(params.data);
    var sign = hexMD5(str);
    params.data.sign = sign;
    wx.request({
      url: url,
      method: method,
      data : params.data,
      header : {
        'content-type':'application/json',
        'token' : wx.getStorageSync('token')
      },
      success: function (res) {
        if (params.sCallback) {          
          var errno,errmsg,data;
          if (res.statusCode == "404") {
            errno = 404;errmsg = "访问的接口不存在";data = "";
          }
          else{
            res = res.data;
            errno = res.return_code;errmsg = res.errorMsg;data = res.data;
          }
          var error = {
            errno: errno,
            errmsg: errmsg,
            msg: res.msg
          };
          return params.sCallback(errno === 0, data, error);
        } 
      },
      fail: function () {
        if (params.sCallback) {
          var errmsg = "服务器连接失败";
          var error = {
            errno: "-1",
            errmsg: errmsg
          };

          return params.sCallback(false, null, error);
        } 
      }
    })
  }
  request_2283(params) {
    var url = Config.baseUrl + params.url;
    if (params.setUrl) {
      url = params.setUrl;
    }

    if (params.method) {
      var method = params.method;
    } else {
      var method = 'get';
    }

    params.data.timestamp = this.getTimestamp();
    var str = arrSort(params.data);
    var sign = hexMD5(str);
    params.data.sign = sign;
    wx.request({
      url: url,
      method: method,
      data: params.data,
      header: {
        'content-type': 'application/json',
        'token': wx.getStorageSync('token')
      },
      success: function (res) {
        console.log(res);
        if (params.sCallback) {

          var errno, errmsg, data;
          if (res.errno == "404") {
            errno = 404; errmsg = "访问的接口不存在"; data = "";
          }
          else {
            res = res.data;
            errno = res.errno; errmsg = res.errorMsg; data = res.data;
          }
          var error = {
            errno: errno,
            errmsg: errmsg,
            msg: res.msg
          };
          return params.sCallback(errno === 0, data, error);
        }
      },
      fail: function () {
        if (params.sCallback) {
          var errmsg = "服务器连接失败";
          var error = {
            errno: "-1",
            errmsg: errmsg
          };

          return params.sCallback(false, null, error);
        }
      }
    })
  }
  
  /*切换CheckBox */
  changeCheckBox(self, dataName, valueName, values) {
    var checkboxItems = self.data[dataName];
    for (var i = 0, lenI = checkboxItems.length; i < lenI; ++i) {
      checkboxItems[i].checked = false;

      for (var j = 0, lenJ = values.length; j < lenJ; ++j) {
        if (checkboxItems[i].value == values[j]) {
          checkboxItems[i].checked = true;
          break;
        }
      }
    }
    var data = {};
    data[valueName] = values;
    data[dataName] = checkboxItems;
    self.setData(data);
  }
  /*切换Radio卡 */
  changeRadios(self, dataName, value) {
    var radioItems = self.data[dataName];
    for (var i = 0, len = radioItems.length; i < len; ++i) {
      radioItems[i].checked = radioItems[i].value == value;
    }
    var data = {};
    data[dataName] = radioItems;
    self.setData(data);
  }
  /*切换tab卡 */
  changeTabs(self,tabsName,indexName,index) {
    let tabs = self.data[tabsName];
    for (let i = 0; i < tabs.length; i++) {
      tabs[i].curr = "";
    }
    tabs[index].curr = "curr";

    var data = {};
    data[tabsName] = tabs;
    data[indexName] = index;

    self.setData(data);
  }

  /*提示框 */
  alert(content) {
    wx.showModal({
      content: content,
      showCancel: false,
      success: function (res) {
        //if (res.confirm) {
        //}
      }
    });
  }
  openConfirm(content,callback) {
    wx.showModal({
      content: content,
      confirmText: "取消",
      cancelText: "确定",
      success: function (res) {
        if (res.confirm) {
          callback();
        } else {
        }
      }
    });
  }
  toast(){
    wx.showToast({
      title: '已完成',
      icon: 'success',
      duration: 3000
    });
  }
  openLoading(msg) {
    if (msg == "") { msg = "数据加载中"}
    wx.showToast({
      title: msg,
      icon: 'loading'
    });
  }
  hideLoading() {
    wx.hideLoading()
  }

  /*加载页面列表 
  this.data 需要参数  listPage要加载的页码 listLook加载和全部加载完成时锁定
  */
  listMore(self, url, data) {
    var that = this;
    //如果没有完成退出
    if (self.data.listLook) {
      return;
    }
    self.setData({
      listLook: true
    });

    var downLoadData = { downLoad: true, downLoadOver: false }
    self.setData({
      downLoadData: downLoadData
    });
    var params = {
      url: url,
      data: data,
      method: "get",
      sCallback: function (success, data, error) {
        if (success) {
          var list = self.data.list;
          var items = data.list;
          for (var i = 0; i < items.length; i++) {
            list.push(items[i]);
          }

          var listLook = false;
          var listPage = self.data.listPage;
          downLoadData = { downLoad: false, downLoadOver: false }
          if (items.length <= 0) {
            downLoadData.downLoadOver = true;
            if (listPage <= 1) {
              downLoadData.downLoadOver = false;
            }
            listLook = true;
          }

          self.setData({
            listPage: listPage + 1,
            listLook: listLook,
            list: list
          });

          self.setData({
            downLoadData: downLoadData
          });
        }
        else {
          self.setData({
            listLook: false,
            downLoadData : { downLoad: false, downLoadOver: false }
          });
          that.alert("数据加载失败");
        }
      }
    };
    this.request(params);
  }
}

export { Base }
