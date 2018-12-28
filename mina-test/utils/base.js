import { Config } from 'config.js';
import { hexMD5 } from 'md5.js';
import { arrSort } from 'sort.js';

class Base {
  constructor(){
    this.restUrl = Config.baseUrl;
    this.timeStorage = '_deadtime';//缓存判断过期时间
  }

  /*时间截 */
  getTimestamp(){
    var timestamp = Date.parse(new Date());
    timestamp = timestamp / 1000;
    return timestamp;
  }

  /*访问后台API */
  request(params){
    var self = this;
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
    var str = encodeURIComponent(arrSort(params.data));
    var sign = hexMD5(str);
    params.data.sign = sign;
    wx.request({
      url: url,
      method: method,
      data : params.data,
      header : {
        'content-type': 'application/json',
        'token': this.getStorageSync('token'),
        'role': this.getStorageSync('loginUserType')
      },
      success: function (res) {
        if (params.sCallback) {
          var errno, errmsg, data;
          if (res.statusCode == "404") {
            errno = 404;errmsg = "访问的接口不存在";data = "";
          }
          else{
            res = res.data;
            if (res.return_code == "401") {//token失效
              self.loginOut();
              return;
            }
            errno = res.return_code; errmsg = res.return_msg;data = res.data;
          }
          var error = {
            errno: errno,
            errmsg: errmsg,
            msg: res.msg
          };
          return params.sCallback(errno == "0", data, error);
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
  sendGet(url, callback) {
    var params = {
      url: url,
      data: {},
      method: "get",
      sCallback: function (success, data, error) {
        callback(success, data, error);
      }
    };
    this.request(params);
  }
  sendPost(url, data, callback) {
    var params = {
      url: url,
      data: data,
      method: "post",
      sCallback: function (success, data, error) {
        callback(success, data, error);
      }
    };
    this.request(params);
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
  changeRadios(self, dataName, valueName, value) {
    var radioItems = self.data[dataName];
    for (var i = 0, len = radioItems.length; i < len; ++i) {
      radioItems[i].checked = radioItems[i].value == value;
    }
    var data = {};
    data[dataName] = radioItems;
    data[valueName] = value;
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
  alert(content, callback) {
    wx.showModal({
      content: content,
      showCancel: false,
      success: function (res) {
        if (res.confirm && callback) {
          callback();
        }
      }
    });
  }
  openConfirm(content,callback) {
    wx.showModal({
      content: content,
      confirmText: "确定",
      cancelText: "取消",
      success: function (res) {
        if (res.confirm) {
          callback();
        } else {
        }
      }
    });
  }
  toast(title){
    if(!title || title==""){ title = '已完成';}
    wx.showToast({
      title: title,
      icon: 'success',
      duration: 3000
    });
  }
  openLoading(msg) {
    if (!msg || msg == "") { msg = "请稍后";}
    wx.showLoading({
      title: msg,
      mask:true
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

  /*计时按钮 */
  setBtnTime(self) {
    var that = this;
    var last_time = self.data.lastTime;
    var count_time = self.data.countTime;
    if (last_time == 0) {
      self.setData({
        btnText: "获取验证码",
        btnDisabled: false,
        btnType: "blue",
        lastTime: count_time
      });
      return;
    } 
    else {
      self.setData({
        btnText: last_time+" 秒后重新获取",
        btnDisabled: true,
        btnType: "default"
      });
      last_time--;
      self.setData({
        lastTime: last_time
      });
    }
    setTimeout(function () {
      that.setBtnTime(self)
    }, 1000);
  }

  /*Number 控件 */
  numberSub(self, dataName, index){
    var nums = self.data[dataName];
    var data = nums[index];
    if (data.value - 1 < data.dataMin) {
      data.value = data.dataMin;
    }
    else {
      data.value--;
    }

    var data2 = {};
    data2[dataName] = nums;

    self.setData(data2);
  }
  numberPlus(self, dataName, index) {
    var nums = self.data[dataName];
    var data = nums[index];
    if (data.value + 1 > data.dataMax) {
      data.value = data.dataMax;
    }
    else {
      data.value++;
    }

    var data2 = {};
    data2[dataName] = nums;

    self.setData(data2);
  }
  numberChange(self, dataName, index, value) {
    var nums = self.data[dataName];
    var data = nums[index];
    if (value < data.dataMin) {
      value = data.dataMin;
    }
    else if (value > data.dataMax) {
      value = data.dataMax;
    }
    data.value = value;

    var data2 = {};
    data2[dataName] = nums;

    self.setData(data2);
  }

  /*设置缓存 */
  //var dtime = '_deadtime';
  setStorageSync(k, v, t) {
    var time_key = k + this.timeStorage;
    wx.setStorageSync(k, v)
    var seconds = parseInt(t);
    if (seconds > 0) {
      var timestamp = Date.parse(new Date());
      timestamp = timestamp / 1000 + seconds;
      wx.setStorageSync(time_key, timestamp + "")
    } else {
      wx.removeStorageSync(time_key)
    }
  }

  getStorageSync(k) {
    var time_key = k + this.timeStorage;
    var deadtime = parseInt(wx.getStorageSync(time_key))
    if (deadtime) {
      if (parseInt(deadtime) < Date.parse(new Date()) / 1000) {
        return "";
      }
    }
    var res = wx.getStorageSync(k);
    if (res) {
      return res;
    } else {
      return "";
    }
  }

  removeStorageSync(k) {
    wx.removeStorageSync(k);
    wx.removeStorageSync(k + this.timeStorage);
  }

  clearStorageSync() {
    wx.clearStorageSync();
  }

  /*扫码注册 */
  devScanCode(isSelfOpen){
    wx.scanCode({
      success(res) {
        var rs = res.result;
        var rss = rs.split('/');

        var url = '/pages/dev/regs/regs?devNo=' + rss[rss.length - 1];
        if (isSelfOpen){
          wx.redirectTo({url: url})
        }
        else {
            wx.navigateTo({url: url})
        }
      }
    })
  }
  /*退出登录 */
  loginOut() {
    this.setStorageSync("token", "", "0");
    wx.reLaunch({
      url: Config.loginPage,
    })
  }

  /*获取元素data- 后面的值 */
  getEData(e,name){
    return e.currentTarget.dataset[name];
  }

  /*获取页面 */
  getPrevPage(delta) {
    var pages = getCurrentPages();
    return pages[pages.length - delta - 1];
  }
}

export { Base }
