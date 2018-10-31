from flask import request

from app.libs.enums import ClientTypeEnums
from app.libs.redprint import Redprint
from app.models.user import User
from app.validators.forms import ClientForm, UserEmailForm

api = Redprint('client')

@api.route('/register', methods=['POST'])
def create_client():
    data = request.json
    form = UserEmailForm(data=data)
    form.validate()
    promise = {
        ClientTypeEnums.USER_EMAIL : __register_user_by_email,
        ClientTypeEnums.USER_MINA : __register_user_by_mina
    }
    res = promise[form.type.data]()

    return 'h'



#通过email注册用户
def __register_user_by_email():
    form = UserEmailForm(data=request.json)
    if form.validate():
        User.register_by_email(form.nickname.data,
                               form.account.data,
                               form.secret.data)
    return 'success'


#通过 小程序登录用户
def __register_user_by_mina():
    pass