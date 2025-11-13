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

// --- Visual press helpers and event wiring (non-destructive) ---
function pressVisual(id) {
	const el = document.getElementById(id);
	if (!el) return;
	el.classList.add('pressed');
}

function releaseVisual(id) {
	const el = document.getElementById(id);
	if (!el) return;
	el.classList.remove('pressed');
}

const keyMap = {
	'w': { id: 'W', fn: Wbutt },
	'a': { id: 'A', fn: Abutt },
	's': { id: 'S', fn: Sbutt },
	'd': { id: 'D', fn: Dbutt }
};

window.addEventListener('keydown', (e) => {
	const k = e.key.toLowerCase();
	if (keyMap[k]) {
		// prevent repeating visual spam on key repeat
		if (e.repeat) return;
		e.preventDefault();
		pressVisual(keyMap[k].id);
		try { keyMap[k].fn(); } catch (err) { console.error(err); }
	}
});

window.addEventListener('keyup', (e) => {
	const k = e.key.toLowerCase();
	if (keyMap[k]) {
		e.preventDefault();
		releaseVisual(keyMap[k].id);
	}
});

['W','A','S','D'].forEach(id => {
	const btn = document.getElementById(id);
	if (!btn) return;
	btn.addEventListener('mousedown', () => pressVisual(id));
	btn.addEventListener('mouseup', () => releaseVisual(id));
	btn.addEventListener('mouseleave', () => releaseVisual(id));
	btn.addEventListener('click', () => {
		const mapping = Object.values(keyMap).find(m => m.id === id);
		if (mapping) mapping.fn();
	});
});

// --- Special Controls Handlers (for specialcontrols.php) ---
async function PUPDbutt() {
	ensureStatusDiv();
	const status = document.getElementById('status');
	if (status) {
		status.textContent = 'Running: Pick Up & Put Down Duck...';
		status.style.color = '#3498db';
	}
	return await postCommand('run_preset', ['pickup_duck']);
}

async function TBbutt() {
	ensureStatusDiv();
	const status = document.getElementById('status');
	if (status) {
		status.textContent = 'Running: Throw Ball...';
		status.style.color = '#3498db';
	}
	return await postCommand('run_preset', ['throw_ball']);
}

async function Wavebutt() {
	ensureStatusDiv();
	const status = document.getElementById('status');
	if (status) {
		status.textContent = 'Running: Wave...';
		status.style.color = '#3498db';
	}
	return await postCommand('run_preset', ['wave']);
}

async function Wigglebutt() {
	ensureStatusDiv();
	const status = document.getElementById('status');
	if (status) {
		status.textContent = 'Running: Wiggle...';
		status.style.color = '#3498db';
	}
	return await postCommand('run_preset', ['wiggle']);
}
