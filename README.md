# robot_simulation
### Robot IP: 10.110.51.25

This repository contains a simple web UI (`webpage/`) and a small Flask API (`data_src/api/server.py`) plus a controller module (`data_src/control_scripts/mycobot_controller.py`) to connect to a MyCobot 280 Pi.

This README explains how to run the website on your laptop (static files) and run the Flask API on the Pi (recommended) or locally, how to point the UI at the API, and how to test basic commands.

Quick summary
- Serve the static UI from `webpage/` (on your laptop) and run the Flask API on the Pi that has the MyCobot attached. Point `webpage/func.js`'s `API_BASE` to `http://<PI_IP>:5000/api`.
- Or run both the UI and API on the same machine for local testing; the controller supports a simulation mode when `pymycobot` is not installed.

Prerequisites
- Python 3.8+ on the Pi (or laptop if you run the API locally)
- (Optional) `pymycobot` to talk to the real MyCobot hardware
- Browser on your laptop to open the UI

Files of interest
- `webpage/index.html`, `webpage/func.js` — front-end UI and JS.
- `data_src/api/server.py` — Flask API that exposes `/api/command` and `/api/ping`.
- `data_src/control_scripts/mycobot_controller.py` — controller module used by the Flask API. It supports simulation when hardware or `pymycobot` is not available.
- `data_src/api/requirements.txt` — Python packages to install for the API.

Option A — Recommended: Serve static UI on laptop, API on the Pi (Pi has the robot attached)

1) Copy the `data_src/` folder to the Pi (or clone the repo on the Pi).

2) On the Pi: create virtualenv, install requirements, and run server

	```bash
	# on the Pi (bash)
	cd /path/to/robot_simulation/data_src/api
	python3 -m venv venv
	source venv/bin/activate
	pip install -r requirements.txt
	# set the device path to your MyCobot serial device, e.g. /dev/ttyUSB0
	export MYCOBOT_ADDR=/dev/ttyUSB0
	# start the API (binds to 0.0.0.0:5000 by default)
	python server.py
	```

3) On your laptop: serve the static UI folder and point the frontend at the Pi API

	```powershell
	# from the repo on Windows PowerShell
	cd 'C:\Users\hsroh\OneDrive\Documents\CS341 - Software Engineering\Repos\robot_simulation\webpage'
	python -m http.server 8000
	# then open http://localhost:8000 in a browser
	```

4) In `webpage/func.js` edit the `API_BASE` constant near the top and set it to point to your Pi (replace <PI_IP>):

	```javascript
	const API_BASE = 'http://<PI_IP>:5000/api';
	```

5) From the browser you can now press buttons in the UI which will call the Pi API. To test the API quickly from your laptop (PowerShell):

	```powershell
	Invoke-RestMethod -Uri 'http://<PI_IP>:5000/api/ping'
	Invoke-RestMethod -Uri 'http://<PI_IP>:5000/api/command' -Method Post -Body (@{action='home'; params=@()} | ConvertTo-Json) -ContentType 'application/json'
	```

Notes for serial permissions
- If you use a serial device (e.g. `/dev/ttyUSB0`), ensure the Pi user running the Flask server has permission to access the device (on many distros this means adding the user to the `dialout` group):

  ```bash
  sudo usermod -a -G dialout $USER
  # then log out / back in or restart the server
  ```

Option B — Run both UI and API locally (for simulation or local robot access)

1) Install and run the Flask API on your laptop (or same machine):

	```powershell
	# PowerShell on Windows (in repo)
	cd .\robot_simulation\data_src\api
	python -m venv venv
	.\venv\Scripts\Activate.ps1
	pip install -r requirements.txt
	# If you do not have a real robot or driver on Windows, skip setting MYCOBOT_ADDR and the controller will run in simulation mode.
	python server.py
	```

2) Serve `webpage/` and open http://localhost:8000. If you run the Flask API on the same host: set `API_BASE` in `webpage/func.js` to `http://localhost:5000/api` or keep it as `/api` and use a reverse proxy.

Quick API usage
- POST /api/command — body JSON { action: string, params: [] }
- GET /api/ping — ping the API

Examples
- Home (no params): {"action": "home", "params": []}
- Move joint 1 to 45 degrees: {"action": "move_joint", "params": [1, 45]}
- Set speed to 60: {"action": "set_speed", "params": [60]}

Security and production notes
- This project is intended for local development. The API enables robot control — do not expose it to untrusted networks without adding authentication, HTTPS, and access controls.
- For a production setup, consider a longer-running Python service (Flask + Gunicorn behind nginx with TLS) and require a token or client certificate for API calls.

Troubleshooting
- If the UI shows "Network error - check API host" or errors in console, confirm:
  - The Flask API is running and bound to an address reachable from your laptop.
  - `API_BASE` in `webpage/func.js` points to the correct host and port.
  - Firewall on the Pi allows port 5000.
  - Serial device path and permissions are correct on the Pi.

If you want, I can:
- Add a simple token-based header check to the Flask API and update the frontend to send the token.
- Add prettier UI controls (joint sliders) and stronger status reporting.
- Replace the PHP approach with this Flask service everywhere in the repo.

Tell me whether you prefer the API on the Pi (Option A) or running locally for now (Option B) and I will add precise commands for your exact setup (including PowerShell commands to copy files to the Pi if needed).