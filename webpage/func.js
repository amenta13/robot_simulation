// Simple frontend functions hooked to buttons in index.html
// Configure API_BASE to point to your Flask API. By default it uses same origin '/api'.
const API_BASE = 'http://localhost:5000/api'; // Flask API running on same machine

async function postCommand(action, params = []) {
	try {
		const resp = await fetch(`${API_BASE}/command`, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify({ action: action, params: params })
		});
		const data = await resp.json();
		console.log('response', data);
		const status = document.getElementById('status');
		if (data.ok) {
			status.textContent = `OK: ${action}`;
			status.style.color = 'black';
		} else {
			status.textContent = `ERR: ${data.error || JSON.stringify(data)}`;
			status.style.color = 'crimson';
		}
		return data;
	} catch (err) {
		console.error(err);
		const status = document.getElementById('status');
		if (status) {
			status.textContent = 'Network error - check API host';
			status.style.color = 'crimson';
		}
		return { ok: false, error: err.toString() };
	}
}

function ensureStatusDiv() {
	if (!document.getElementById('status')) {
		const s = document.createElement('div');
		s.id = 'status';
		s.style.marginTop = '12px';
		document.body.appendChild(s);
	}
}

// Example button handlers that move joints
// Adjust joint indexes and angles as needed for your robot

// helper: move a joint to an absolute angle
async function moveJoint(index, angle) {
    return await postCommand('move_joint', [index, angle]);
}

// simple preset moves — these assume joint 1/2 exist
async function Wbutt() { // e.g. rotate joint 1 positive
    ensureStatusDiv();
    await moveJoint(1, 10); // set to 10 degrees (or change to desired angle)
}

async function Sbutt() { // rotate joint 1 negative
    ensureStatusDiv();
    await moveJoint(1, -10);
}

async function Abutt() { // rotate joint 2 negative
    ensureStatusDiv();
    await moveJoint(2, -10);
}

async function Dbutt() { // rotate joint 2 positive
    ensureStatusDiv();
    await moveJoint(2, 10);
}
