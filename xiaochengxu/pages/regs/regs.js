import { Base } from '../../util/base.js';
var base = new Base();

Page({
  data: {
    mobile: "",
    comfooter: {
      ver_no: 'v-1.0.0',
      phone_no: '0760-88888888'
    }
  },
  bindInput: function (e) {
    this.data[e.currentTarget.dataset.name] = e.detail.value;
  },

  onReg: function (e) {
    var data = {
      code:wx.getStorageSync("code"),
      user_name: this.data.userName,
      pass_word: this.data.rePassword,
      re_pass_word: this.data.rePassword,
      mobile: this.data.mobile
    }
    var params = {
      url: "register",
      data: data,
      method: "post",
      sCallback: function (success, data, error) {
        if (success) {
          //wx.setStorageSync('token', data);
          //console.log(data.data.token);
          //base.alert("注册成功");
          //console.log(data);
        }
        else {
          base.alert(error.errmsg);
        }
      }
    };
    base.request(params);
  },
  getMsgCode:function(e){
    var mobile = this.data.mobile;
    if(mobile == ''){
      base.alert('请先填写您的电话号码');
    } 
    else {
      console.log(mobile)
    }
  }
})
