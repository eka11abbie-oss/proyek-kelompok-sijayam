from flask import Flask, jsonify

app = Flask(__name__)

# Endpoint dasar buat ngecek server jalan atau nggak
@app.route('/', methods=['GET'])
def home():
    return jsonify({
        "status": "success", 
        "message": "Server Backend Sijayam berhasil jalan!"
    })

if __name__ == '_main_':
    app.run(debug=True, port=5000)