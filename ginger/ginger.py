from app.app import create_app

app = create_app()

@app.route('/v1/getUser')
def getUser():
    return 'hello python'

@app.route('/v1/getBook')
def getBook():
    return 'get book'



if __name__ == '__main__':
    app.run(debug=True)