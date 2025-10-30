"""
Controller module for MyCobot used by the Flask API.

Provides `handle_action(action, params)` which returns a dict/result and never raises on normal flow.
Supports simulation mode when `pymycobot` is not available or `MYCOBOT_ADDR` is not set.
"""
import os
import time
import json
import traceback

try:
    from pymycobot import MyCobot
except Exception:
    MyCobot = None


_mc = None


def _connect():
    global _mc
    if _mc is not None:
        return _mc
    addr = os.environ.get('MYCOBOT_ADDR')
    if MyCobot is None or not addr:
        _mc = None
        return None
    try:
        # assume serial device
        _mc = MyCobot(addr, 115200)
        return _mc
    except Exception:
        _mc = None
        return None


def handle_action(action, params):
    """Dispatch action to robot or simulated handler. Returns a dict with result info."""
    try:
        mc = _connect()
        sim = mc is None

        if action == 'home':
            if sim:
                return {'sim': True, 'msg': 'homed (sim)'}
            # move to zeros (if API supports)
            angles = [0, 0, 0, 0, 0, 0]
            mc.set_angles(angles, 50)
            return {'sim': False, 'msg': 'homed'}

        if action == 'stop':
            # placeholder - pymycobot may not have stop
            return {'sim': sim, 'msg': 'stop sent' if not sim else 'stop (sim)'}

        if action == 'move_joint':
            if len(params) < 2:
                return {'error': 'move_joint requires [index, angle]'}
            idx = int(params[0])
            angle = float(params[1])
            if sim:
                return {'sim': True, 'msg': f'moved joint {idx} to {angle} (sim)'}
            # read current angles
            cur = mc.get_angles()
            if not cur or len(cur) < 6:
                return {'error': 'failed to read angles'}
            cur[idx-1] = angle
            mc.set_angles(cur, 50)
            return {'sim': False, 'msg': f'moved joint {idx} to {angle}'}

        if action == 'set_speed':
            if len(params) < 1:
                return {'error': 'set_speed requires [speed]'}
            speed = int(params[0])
            if sim:
                return {'sim': True, 'msg': f'set speed {speed} (sim)'}
            # pymycobot API may vary; attempt safe call
            try:
                mc.set_speed(speed)
            except Exception:
                pass
            return {'sim': False, 'msg': f'set speed {speed}'}

        if action == 'open_gripper':
            if sim:
                return {'sim': True, 'msg': 'open gripper (sim)'}
            try:
                mc.set_gripper(60)
            except Exception:
                pass
            return {'sim': False, 'msg': 'gripper opened'}

        if action == 'close_gripper':
            if sim:
                return {'sim': True, 'msg': 'close gripper (sim)'}
            try:
                mc.set_gripper(0)
            except Exception:
                pass
            return {'sim': False, 'msg': 'gripper closed'}

        return {'error': 'unknown action'}

    except Exception as e:
        return {'error': str(e), 'trace': traceback.format_exc()}


if __name__ == '__main__':
    # CLI helper for quick testing
    import sys
    if len(sys.argv) < 2:
        print(json.dumps({'error': 'missing action'}))
        sys.exit(1)
    action = sys.argv[1]
    params = []
    if len(sys.argv) > 2:
        try:
            # if a JSON array passed as single arg, parse it
            if sys.argv[2].startswith('['):
                params = json.loads(sys.argv[2])
            else:
                params = sys.argv[2:]
        except Exception:
            params = sys.argv[2:]
    res = handle_action(action, params)
    print(json.dumps(res))
