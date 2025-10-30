#!/usr/bin/env python3
"""
Minimal Flask API to control MyCobot.

Endpoints:
  POST /api/command  -> { action: string, params: [] }

Run:
  python server.py

The API uses `data_src/control_scripts/mycobot_controller.py` for hardware access.
"""
from flask import Flask, request, jsonify
from flask_cors import CORS
import os
import traceback

app = Flask(__name__)
CORS(app)

# import controller module from sibling folder
import sys
from pathlib import Path
ROOT = Path(__file__).resolve().parents[1]
sys.path.insert(0, str(ROOT))
try:
    from control_scripts import mycobot_controller as controller
except Exception:
    controller = None


@app.route('/api/command', methods=['POST'])
def command():
    try:
        data = request.get_json(force=True)
        action = data.get('action')
        params = data.get('params', [])
        if not action:
            return jsonify({'ok': False, 'error': 'missing action'}), 400

        if controller is None:
            return jsonify({'ok': False, 'error': 'controller module not available'}), 500

        result = controller.handle_action(action, params)
        return jsonify({'ok': True, 'result': result})
    except Exception as e:
        tb = traceback.format_exc()
        return jsonify({'ok': False, 'error': str(e), 'trace': tb}), 500


@app.route('/api/ping', methods=['GET'])
def ping():
    return jsonify({'ok': True, 'msg': 'pong'})


if __name__ == '__main__':
    host = os.environ.get('FLASK_HOST', '0.0.0.0')
    port = int(os.environ.get('FLASK_PORT', '5000'))
    print(f"Starting Flask API on {host}:{port}")
    app.run(host=host, port=port)
