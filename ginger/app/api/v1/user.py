from app.libs.redprint import Redprint

api = Redprint('user')

@api.route('/getUser')
def get_user():
    return 'get user'